<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\StudentGroup;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Tampilan awal untuk input Kode Sesi
     */
    public function showJoinForm()
    {
        return view('student.JoinSesi');
    }

    /**
     * Validasi Kode Sesi dari Guru
     */
    public function checkSession(Request $request)
    {
        $request->validate([
            'session_code' => 'required|string',
        ]);

        $session = Session::where('session_code', strtoupper($request->session_code))
                             ->where('is_active', true)
                             ->first();

        if (!$session) {
            return back()->with('error', 'Kode sesi tidak valid atau sudah dinonaktifkan oleh Guru.');
        }

        return redirect()->route('student.phase1', $session->session_code);
    }

    /**
     * Menampilkan Fase 1: Narasi Masalah
     */
    public function showPhase1($session_code)
    {
        $session = Session::where('session_code', $session_code)
                             ->where('is_active', true)
                             ->firstOrFail();

        return view('student.fase1', compact('session'));
    }

    /**
     * Membuat Grup Baru atau Masuk ke Grup Lama (Resume)
     */
    public function joinGroup(Request $request, $session_code)
    {
        $session = Session::where('session_code', $session_code)->firstOrFail();

        $request->validate([
            'group_name' => 'required|string|max:100',
        ]);

        // Logic: Cari yang sudah ada (Resume) atau Buat Baru
        $group = StudentGroup::firstOrCreate(
            [
                'session_id' => $session->id,
                'group_name' => strtoupper($request->group_name)
            ],
            [
                'current_phase' => 3, // Start di Fase 3 setelah baca narasi
                'student_data' => []
            ]
        );

        $targetPhase = ($group->wasRecentlyCreated) ? 3 : $group->current_phase;

        return redirect()->route('student.phase', [
            'session_code' => $session->session_code,
            'group_id' => $group->id,
            'phase' => $targetPhase
        ]);
    }

    /**
     * Menampilkan Fase (3, 4, atau 5) dengan data pertanyaan dari Session
     */
    public function showPhase($session_code, $group_id, $phase)
    {
        $session = Session::where('session_code', $session_code)->firstOrFail();
        $group = StudentGroup::where('id', $group_id)
                             ->where('session_id', $session->id)
                             ->firstOrFail();

        // Security: Mencegah lompat fase lewat URL
        if ($phase > $group->current_phase) {
            return redirect()->route('student.phase', [$session_code, $group->id, $group->current_phase]);
        }

        // Logic Mirroring: Ambil pertanyaan yang sesuai dengan fase dari kolom array di tabel sessions
        $questions = [];
        if ($phase == 3) {
            $questions = $session->f3_questions; // Diambil dari array f3_questions di pbl_sessions
        } elseif ($phase == 5) {
            $questions = $session->f5_questions; // Diambil dari array f5_questions di pbl_sessions
        }

        return view("student.fasekeseluruhan", compact('session', 'group', 'questions'));
    }

    /**
     * Menyimpan progres jawaban murid per fase
     */
    public function savePhase(Request $request, $session_code, $group_id, $phase)
    {
        $group = StudentGroup::findOrFail($group_id);

        if ($phase == 3) {
            // Simpan ke kolom f3_answers (otomatis jadi JSON karena casting di model)
            $group->update([
                'f3_answers' => $request->answers,
                'current_phase' => 4
            ]);
        } 
        elseif ($phase == 4) {
            $group->update([
                'f4_description' => $request->f4_description,
                'f4_code' => $request->f4_code,
                'current_phase' => 5
            ]);
        } 
        elseif ($phase == 5) {
            $group->update([
                'f5_answers' => $request->answers,
                'is_submitted' => true
            ]);
            
            return redirect()->route('student.complete', [$session_code, $group->id]);
        }

        return redirect()->route('student.phase', [$session_code, $group->id, $group->current_phase]);
    }

    public function complete($session_code, $group_id)
    {
        return view('student.complete', compact('session_code', 'group_id'));
    }

    public function saveAll(Request $request, $session_code, $group_id)
    {
        $group = StudentGroup::findOrFail($group_id);

        // Update data termasuk anggota kelompok di Fase 2
        $group->update([
            'f3_answers' => $request->f3_answers,
            'f4_code' => $request->f4_code,
            'f4_answers' => $request->f4_answers,
            'f5_answers' => $request->f5_answers,
            // Simpan members ke dalam student_data agar rapi
            'student_data' => [
                'members' => $request->members,
                // Jika ada data student_data lain, gabungkan di sini
            ]
        ]);

        if ($request->action == 'submit') {
            $group->update(['is_submitted' => true]);
            return redirect()->route('student.complete', [$session_code, $group->id]);
        }

        return back()->with('success', 'Data kelompok dan progres berhasil disimpan!');
    }
}