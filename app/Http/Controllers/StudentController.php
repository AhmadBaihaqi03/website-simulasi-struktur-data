<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\StudentGroup;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //Validasi Kode Sesi dari Guru
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
        //ini ke halaman lama pakai bootstrap
        //return redirect()->route('student.phase1', $session->session_code);
        //ini coba kuganti ke halaman baru pakai tailwind
        return redirect()->route('student.orientasi', $session->session_code);
    }

    // menampilkan halaman orientasi yang baru
    public function showOrientasi($session_code)
    {
        $session = Session::where('session_code', $session_code)
                             ->where('is_active', true)
                             ->firstOrFail();

        return view('student.orientasi', compact('session'));
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

    // Membuat Grup Baru atau Masuk ke Grup Lama (Resume)
    public function joinGroup(Request $request, $session_code)
    {
        $session = Session::where('session_code', $session_code)->firstOrFail();

        $request->validate([
            'group_name' => 'required|string|max:100',
        ]);

        $group = StudentGroup::firstOrCreate(
            [
                'session_id' => $session->id,
                'group_name' => strtoupper($request->group_name)
            ],
            [
                'current_phase' => 3, 
                'student_data' => []
            ]
        );

        // Jika murid mencoba login kembali padahal sudah submit, langsung ke halaman complete
        if ($group->is_submitted) {
            return redirect()->route('student.complete', [$session->session_code, $group->id]);
        }

        $targetPhase = ($group->wasRecentlyCreated) ? 3 : $group->current_phase;

        return redirect()->route('student.phase', [
            'session_code' => $session->session_code,
            'group_id' => $group->id,
            'phase' => $targetPhase
        ]);
    }

    // Menampilkan Fase (Workspace Utama)
    public function showPhase($session_code, $group_id, $phase)
    {
        $session = Session::where('session_code', $session_code)->firstOrFail();
        $group = StudentGroup::where('id', $group_id)
                             ->where('session_id', $session->id)
                             ->firstOrFail();

        // PROTEKSI: Jika sudah submit, tidak boleh edit lagi
        if ($group->is_submitted) {
            return redirect()->route('student.complete', [$session_code, $group->id]);
        }

        // Security: Mencegah lompat fase lewat URL
        if ($phase > $group->current_phase) {
            return redirect()->route('student.phase', [$session_code, $group->id, $group->current_phase]);
        }

        $questions = [];
        if ($phase == 3) {
            $questions = $session->f3_questions;
        } elseif ($phase == 5) {
            $questions = $session->f5_questions;
        }

        //halaman lama pakai bootstrap
        //return view("student.fasekeseluruhan", compact('session', 'group', 'questions'));
        //halaman baru pakai tailwind
        return view("student.workspace", compact('session', 'group', 'questions'));
    }

    // Menyimpan semua data (Save & Submit)
    public function saveAll(Request $request, $session_code, $group_id)
    {
        $group = StudentGroup::findOrFail($group_id);
        
        // 1. Ambil semua nama inputan dari form
        $inputMembers = collect($request->members)->filter()->map(fn($n) => trim($n));

        // 2. Validasi Duplikasi Internal (dalam satu kelompok yang sama)
        if ($inputMembers->count() !== $inputMembers->unique()->count()) {
            return back()->with('error', 'Ada nama anggota yang ganda di inputan kelompok Anda!')->withInput();
        }

        // 3. Validasi Duplikasi Berdasarkan Guru (Teacher-Level Validation)
        $teacherId = $group->session()->first()->user_id;

        foreach ($inputMembers as $name) {
            $exists = StudentGroup::where('id', '!=', $group_id) // Kecuali kelompok sendiri
                ->whereHas('session', function($query) use ($teacherId) {
                    $query->where('user_id', $teacherId); // Harus dalam lingkup guru yang sama
                })
                ->where('student_data->members', 'LIKE', '%"' . $name . '"%')
                ->exists();

            if ($exists) {
                return back()->with('error', "Nama '$name' sudah terdaftar di kelas lain milik guru ini!")->withInput();
            }
        }
        

        // Update data jika lolos validasi
        $group->update([
            'f3_answers' => $request->f3_answers,
            'f4_link'    => $request->f4_link,
            'f4_code' => $request->f4_code,
            'f4_answers' => $request->f4_answers,
            'f5_answers' => $request->f5_answers,
            'student_data' => [
                'members' => $request->members,
            ]
        ]);

        if ($request->action == 'submit') {
            $group->update(['is_submitted' => true, 'current_phase' => 5]);
            return redirect()->route('student.complete', [$session_code, $group->id])->with('success', 'Tugas dikirim!');
        }

        return back()->with('success', 'Progres berhasil disimpan!');
    }

    // 4. Fungsi Baru untuk Live Check (AJAX) - Filter by Teacher
    public function checkMemberName(Request $request)
    {
        $name = trim($request->name);
        $groupId = $request->group_id;

        // Cari dulu kelompok ini untuk dapat ID Gurunya
        $group = StudentGroup::with('session')->find($groupId);
        if (!$group || !$group->session) {
            return response()->json(['exists' => false]);
        }

        $teacherId = $group->session->user_id;

        // Cek duplikasi di semua sesi milik guru tersebut
        $exists = StudentGroup::where('id', '!=', $groupId)
            ->whereHas('session', function($query) use ($teacherId) {
                $query->where('user_id', $teacherId);
            })
            ->where('student_data->members', 'LIKE', '%"' . $name . '"%')
            ->exists();

        return response()->json(['exists' => $exists]);
    }

    // Halaman sukses setelah submit
    public function complete($session_code, $group_id)
    {
        // 1. Ambil data Session berdasarkan kodenya
        $session = \App\Models\Session::where('session_code', $session_code)->firstOrFail();

        // 2. Ambil data Group beserta evaluasinya (Eager Loading agar tidak berat)
        $group = \App\Models\StudentGroup::with('evaluation')->findOrFail($group_id);

        // 3. Pastikan group memang sudah submit
        if (!$group->is_submitted) {
            return redirect()->route('student.phase', [$session_code, $group->id, $group->current_phase]);
        }

    // 4. Lempar variabel $session ke view (Sangat Penting!)
    // halaman lama dengan bootstrap
    // return view('student.complete', compact('session', 'group'));
    // halaman baru dengan tailwind
    return view('student.viewfeedback', compact('session', 'group'));
    }
}