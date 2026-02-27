<?php

namespace App\Http\Controllers;

use App\Models\StudentGroup;
// use App\Models\Evaluation;   // Untuk proses simpan nilai nanti
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    // Method untuk menampilkan halaman jawaban & form nilai
    public function show(StudentGroup $group)
    {
        // Load relasi agar data sesi dan evaluasi terbaca
        $group->load(['session', 'evaluation']);
        
        $session = $group->session;
        $evaluation = $group->evaluation;
        
        // Ambil jawaban dari kolom student_data (dalam bentuk array)
        $answers = $group->student_data['answers'] ?? [];

        // Memanggil file showevaluation.blade.php
        return view('sessions.showevaluation', compact('group', 'session', 'evaluation', 'answers'));
    }

    // Method untuk menyimpan nilai dari form (untuk tombol "Simpan Hasil Evaluasi")
    public function store(Request $request, StudentGroup $group)
    {
        $request->validate([
            'score' => 'required|integer|min:0|max:100',
            'feedback_comment' => 'nullable|string'
        ]);

        // Simpan atau update nilai ke tabel evaluations
        $group->evaluation()->updateOrCreate(
            ['student_group_id' => $group->id],
            [
                'score' => $request->score,
                'feedback_comment' => $request->feedback_comment
            ]
        );

        return redirect()->route('sessions.evaluations', $group->session_id)
                         ->with('success', 'Penilaian untuk ' . $group->group_name . ' berhasil disimpan!');
    }
}