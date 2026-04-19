<?php

namespace App\Http\Controllers;

use App\Models\StudentGroup;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EvaluationController extends Controller
{
    // Method untuk menampilkan halaman jawaban & form nilai
    public function show(StudentGroup $group)
    {
        // Load relasi agar data sesi dan evaluasi terbaca
        $group->load('session');

        // Ensure evaluation exists or create empty one
        if (!$group->evaluation) {
            $group->evaluation = Evaluation::firstOrCreate(
                ['student_group_id' => $group->id],
                ['feedback_comment' => null]
            );
        } else {
            $group->load('evaluation');
        }

        $session = $group->session;
        $evaluation = $group->evaluation;

        // Ambil jawaban dari kolom student_data (dalam bentuk array)
        $answers = $group->student_data['answers'] ?? [];

        // Debug: log untuk memastikan evaluation dimuat
        Log::info('Loading evaluation for group', [
            'group_id' => $group->id,
            'has_evaluation' => !is_null($evaluation),
            'feedback' => $evaluation?->feedback_comment ?? 'No feedback',
            'created_at' => $evaluation?->created_at
        ]);

        // Memanggil file showevaluation.blade.php
        return view('sessions.showevaluation', compact('group', 'session', 'evaluation', 'answers'));
    }

    // Method untuk menyimpan nilai dari form (untuk tombol "Simpan Hasil Evaluasi")
    public function store(Request $request, StudentGroup $group)
    {
        // Validasi feedback harus diisi minimal 5 karakter
        $validated = $request->validate([
            'feedback_comment' => 'required|string|min:5'
        ], [
            'feedback_comment.required' => 'Umpan balik guru tidak boleh kosong.',
            'feedback_comment.min' => 'Umpan balik guru minimal 5 karakter.'
        ]);

        try {
            // Trim whitespace dari feedback
            $feedbackContent = trim($validated['feedback_comment']);

            // Log the incoming request
            Log::info('Saving feedback', [
                'group_id' => $group->id,
                'feedback_length' => strlen($feedbackContent),
                'feedback_preview' => substr($feedbackContent, 0, 50)
            ]);

            // Simpan atau update feedback ke tabel evaluations
            $evaluation = $group->evaluation()->updateOrCreate(
                ['student_group_id' => $group->id],
                [
                    'feedback_comment' => $feedbackContent
                ]
            );

            // Verify save was successful
            $evaluation->refresh();

            Log::info('Feedback saved successfully', [
                'group_id' => $group->id,
                'evaluation_id' => $evaluation->id,
                'feedback_length' => strlen($evaluation->feedback_comment),
                'saved_feedback_preview' => substr($evaluation->feedback_comment, 0, 50)
            ]);

            // Redirect dengan success message
            return redirect()->route('sessions.evaluations', $group->session_id)
                           ->with('success', '✅ Umpan balik untuk ' . $group->group_name . ' berhasil disimpan!');
        } catch (\Exception $e) {
            Log::error('Error saving feedback', [
                'group_id' => $group->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Jika terjadi error, kembalikan dengan pesan error
            return redirect()->back()
                           ->withInput()
                           ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan umpan balik: ' . $e->getMessage()]);
        }
    }
}
