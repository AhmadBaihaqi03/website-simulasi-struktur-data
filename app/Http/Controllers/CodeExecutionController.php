<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CodeExecutionController extends Controller
{
    // Services configuration
    private const SERVICES = [
        'jdoodle' => [
            'url' => 'https://api.jdoodle.com/execute',
            'language' => 'c'
        ],
        'ideone' => [
            'url' => 'https://ideone.com/api/1/',
            'language' => 'C'
        ]
    ];

    public function testConnectivity()
    {
        $results = [
            'php_version' => phpversion(),
            'allow_url_fopen' => ini_get('allow_url_fopen') ? 'Enabled' : 'Disabled',
            'curl_available' => extension_loaded('curl') ? 'Yes' : 'No',
        ];

        // Test DNS resolution
        $ip = @gethostbyname('run.glot.io');
        $results['glot_io_dns'] = ($ip !== 'run.glot.io') ? "Resolved: {$ip}" : "❌ Failed to resolve";

        // Test alternative services
        $results['jdoodle_test'] = $this->testService('https://api.jdoodle.com/execute');
        $results['ideone_test'] = $this->testService('https://ideone.com/api/1/');

        return response()->json($results);
    }

    private function testService($url)
    {
        try {
            $response = Http::timeout(5)->connectTimeout(3)->head($url);
            return "✓ Accessible (Status: {$response->status()})";
        } catch (\Exception $e) {
            return "✗ Failed: " . class_basename($e);
        }
    }

    public function executeC(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string'
        ]);

        // Safety check - prevent infinite loops
        if (str_contains($validated['code'], 'while(1)') || str_contains($validated['code'], 'for(;;)')) {
            return response()->json([
                'stdout' => '',
                'stderr' => 'Warning: Infinite loop detected. Program terminated.',
                'statusCode' => 1
            ]);
        }

        // Try JDoodle with proper error handling
        $jdoodleResult = $this->executeViaJDoodle($validated['code']);
        if ($jdoodleResult !== null) {
            return $jdoodleResult;
        }

        // Fallback: try local GCC compiler
        $localResult = $this->executeViaLocalGCC($validated['code']);
        if ($localResult !== null) {
            return $localResult;
        }

        // Demo mode - return simulated output based on code content
        return $this->executeDemoMode($validated['code']);
    }

    private function executeViaJDoodle($code)
    {
        try {
            $clientId = env('JDOODLE_CLIENT_ID');
            $clientSecret = env('JDOODLE_CLIENT_SECRET');

            if (!$clientId || !$clientSecret) {
                return null;
            }

            $payload = [
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
                'script' => $code,
                'language' => 'c',
                'versionIndex' => '4'
            ];

            $response = Http::timeout(30)
                ->connectTimeout(10)
                ->post('https://api.jdoodle.com/execute', $payload);

            if ($response->successful()) {
                $data = $response->json();

                return response()->json([
                    'stdout' => $data['output'] ?? '',
                    'stderr' => $data['error'] ?? '',
                    'statusCode' => $data['statusCode'] ?? 0
                ]);
            }

            return null;
        } catch (\Exception $e) {
            \Log::debug('JDoodle failed, will try fallback', [
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    private function executeViaGlot($code)
    {
        try {
            $response = Http::timeout(30)
                ->connectTimeout(10)
                ->retry(2, 1000)
                ->post('https://run.glot.io/languages/c/latest', [
                    'files' => [
                        [
                            'name' => 'main.c',
                            'content' => $code
                        ]
                    ]
                ], [
                    'Authorization' => 'Token 0c946e96-6644-4632-8419-798836587093'
                ]);

            if ($response->successful()) {
                return response()->json($response->json());
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    private function executeViaLocalGCC($code)
    {
        try {
            // Only attempt on Windows (check if cmd.exe exists)
            if (!$this->isWindowsWithGCC()) {
                return null;
            }

            $tempDir = storage_path('temp_code');
            if (!is_dir($tempDir)) {
                mkdir($tempDir, 0777, true);
            }

            $sourceFile = $tempDir . '\\main_' . uniqid() . '.c';
            $exeFile = str_replace('.c', '.exe', $sourceFile);

            // Write code to temporary file
            file_put_contents($sourceFile, $code);

            // Compile using GCC
            $compileCmd = "gcc \"{$sourceFile}\" -o \"{$exeFile}\" 2>&1";
            $compileOutput = shell_exec($compileCmd);

            if (!file_exists($exeFile)) {
                $error = $compileOutput ?: 'Compilation failed: gcc not found or compilation error';
                unlink($sourceFile);
                return response()->json([
                    'error' => 'Compilation failed',
                    'stderr' => $error
                ], 400);
            }

            // Execute the compiled program with timeout
            $execCmd = "\"{$exeFile}\" 2>&1";

            // Use proc_open to control execution with timeout
            $descriptors = [
                0 => ['pipe', 'r'],
                1 => ['pipe', 'w'],
                2 => ['pipe', 'w']
            ];

            $process = proc_open($execCmd, $descriptors, $pipes);

            if (is_resource($process)) {
                fclose($pipes[0]);

                // Read output with timeout (5 seconds max)
                $output = '';
                $startTime = time();
                $timeout = 5;

                while (!feof($pipes[1])) {
                    if (time() - $startTime > $timeout) {
                        proc_terminate($process);
                        $output .= "\n[Process timeout after 5 seconds]";
                        break;
                    }
                    $output .= fgets($pipes[1], 1024);
                }

                fclose($pipes[1]);
                fclose($pipes[2]);
                proc_close($process);

                // Cleanup
                if (file_exists($exeFile)) unlink($exeFile);
                if (file_exists($sourceFile)) unlink($sourceFile);

                return response()->json([
                    'stdout' => $output,
                    'stderr' => ''
                ]);
            }

            return null;
        } catch (\Exception $e) {
            \Log::error('Local GCC Error:', [
                'message' => $e->getMessage()
            ]);
            return null;
        }
    }

    private function isWindowsWithGCC()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            return false;
        }

        $gccCheck = shell_exec('where gcc 2>&1');
        return !empty($gccCheck) && strpos($gccCheck, 'gcc') !== false;
    }

    public function systemInfo()
    {
        return response()->json([
            'os' => PHP_OS_FAMILY,
            'php_version' => phpversion(),
            'extensions' => [
                'curl' => extension_loaded('curl'),
                'openssl' => extension_loaded('openssl'),
                'json' => extension_loaded('json')
            ],
            'compiler' => [
                'gcc_available' => $this->isWindowsWithGCC(),
                'gcc_path' => $this->isWindowsWithGCC() ? shell_exec('where gcc 2>&1') : 'Not found'
            ],
            'environment' => [
                'jdoodle_configured' => !empty(env('JDOODLE_CLIENT_ID')),
                'internet_accessible' => $this->testService('https://api.jdoodle.com/execute')
            ],
            'install_gcc_guide' => [
                'windows' => 'Download MinGW-w64 from: https://www.mingw-w64.org/downloads/',
                'linux' => 'sudo apt-get install gcc',
                'macos' => 'brew install gcc'
            ]
        ]);
    }

    private function executeDemoMode($code)
    {
        // Simple parser untuk detect output dari code
        $output = '';

        // Check untuk printf/puts arguments
        if (preg_match('/printf\s*\(\s*"([^"]+)"/', $code, $matches)) {
            $output = $matches[1] . "\n";
        }

        // Check untuk puts
        if (preg_match('/puts\s*\(\s*"([^"]+)"/', $code, $matches)) {
            $output .= $matches[1] . "\n";
        }

        // Check untuk loops or calculations
        if (preg_match('/for\s*\([^;]+;[^;]+;[^)]+\)/i', $code)) {
            $output .= "[Loop detected - code simulation mode]\n";
        }

        // Check untuk arrays
        if (preg_match('/\[\d+\]|int\s+\w+\[\d+\]/i', $code)) {
            $output .= "[Array operations detected]\n";
        }

        // Fallback message
        if (empty($output)) {
            $output = "[Program executed successfully - no output]\n";
        }

        return response()->json([
            'stdout' => $output,
            'stderr' => '[DEMO MODE] Lokasi: Offline compilation. Untuk eksekusi sebenarnya, install GCC atau periksa koneksi internet.',
            'statusCode' => 0,
            '_mode' => 'demo'
        ]);
    }
}
