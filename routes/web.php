<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CodeExecutionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // API untuk menjalankan kode C
    Route::post('/api/execute-c', [CodeExecutionController::class, 'executeC'])->name('execute.c');

    // Debug route untuk test koneksi
    Route::get('/api/test-connectivity', [CodeExecutionController::class, 'testConnectivity'])->name('test.connectivity');

    // Route untuk check environment
    Route::get('/api/system-info', [CodeExecutionController::class, 'systemInfo'])->name('system.info');

    // Rute untuk dashboard utama guru
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute untuk manajemen profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk manajemen sesi pada dashboard
    Route::get('/sessions/create', [SessionController::class, 'create'])->name('sessions.create');
    Route::post('/sessions', [SessionController::class, 'store'])->name('sessions.store');
    Route::get('/sessions/{session}/edit', [SessionController::class, 'edit'])->name('sessions.edit');
    Route::put('/sessions/{session}', [SessionController::class, 'update'])->name('sessions.update');
    Route::patch('/sessions/{session}/toggle', [SessionController::class, 'toggle'])->name('sessions.toggle');
    Route::delete('/sessions/{session}', [SessionController::class, 'destroy'])->name('sessions.destroy');

    // Rute Evaluasi
    Route::get('/sessions/{session}/evaluations', [SessionController::class, 'evaluations'])->name('sessions.evaluations');
    Route::get('/groups/{group}/work', [EvaluationController::class, 'show'])->name('groups.work');
    Route::post('/groups/{group}/evaluate', [EvaluationController::class, 'store'])->name('groups.evaluate');
});

require __DIR__.'/auth.php';

Route::prefix('pbl')->group(function () {
    // 1. Pintu Masuk
    Route::get('/join', [StudentController::class, 'showJoinForm'])->name('student.join');
    Route::post('/join', [StudentController::class, 'checkSession'])->name('student.join.check');

    // 2. Fase 1 & Modal Nama Kelompok
    Route::get('/{session_code}/introduction', [StudentController::class, 'showPhase1'])->name('student.phase1');
    Route::post('/{session_code}/join-group', [StudentController::class, 'joinGroup'])->name('student.join.group');

    // 3. Halaman Workspace Utama (Satu Halaman untuk Semua Fase)
    Route::get('/{session_code}/workspace/{group_id}/{phase?}', [StudentController::class, 'showPhase'])->name('student.phase');

    // 4. Proses Simpan Massal & Submit
    Route::post('/{session_code}/workspace/{group_id}/save-all', [StudentController::class, 'saveAll'])->name('student.save.all');

    // 5. Halaman Selesai
    Route::get('/{session_code}/complete/{group_id}', [StudentController::class, 'complete'])->name('student.complete');
});
