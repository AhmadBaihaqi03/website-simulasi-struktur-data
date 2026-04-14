<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\StudentGroup;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Validasi Kode Sesi dari Guru
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

        return redirect()->route('student.orientasi', $session->session_code);
    }

    // Halaman orientasi
    public function showOrientasi($session_code)
    {
        $session = Session::where('session_code', $session_code)
            ->where('is_active', true)
            ->firstOrFail();

        return view('student.orientasi', compact('session'));
    }

    // Join / Create Group
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
                'student_data' => [],
            ]
        );

        if ($group->is_submitted) {
            return redirect()->route('student.complete', [$session->session_code, $group->id]);
        }

        // LANGSUNG KE WORKSPACE (tanpa phase)
        return redirect()->route('student.workspace', [
            'session_code' => $session->session_code,
            'group_id' => $group->id,
        ]);
    }

    // Workspace utama
    public function showWorkspace($session_code, $group_id)
    {
        $session = Session::where('session_code', $session_code)->firstOrFail();

        $group = StudentGroup::where('id', $group_id)
            ->where('session_id', $session->id)
            ->firstOrFail();

        if ($group->is_submitted) {
            return redirect()->route('student.complete', [$session_code, $group->id]);
        }

        return view('student.workspace', compact('session', 'group'));
    }

    // Save & Submit
    public function saveAll(Request $request, $session_code, $group_id)
    {
        $group = StudentGroup::findOrFail($group_id);

        $inputMembers = collect($request->members)
            ->filter()
            ->map(fn($n) => trim($n));

        if ($inputMembers->count() !== $inputMembers->unique()->count()) {
            return back()->with('error', 'Ada nama anggota yang ganda di inputan kelompok Anda!')->withInput();
        }

        $teacherId = $group->session()->first()->user_id;

        foreach ($inputMembers as $name) {
            $exists = StudentGroup::where('id', '!=', $group_id)
                ->whereHas('session', function($query) use ($teacherId) {
                    $query->where('user_id', $teacherId);
                })
                ->where('student_data->members', 'LIKE', '%"' . $name . '"%')
                ->exists();

            if ($exists) {
                return back()->with('error', "Nama '$name' sudah terdaftar di kelas lain milik guru ini!")->withInput();
            }
        }

        $group->update([
            'class_name' => $request->class_name,
            'f3_answers' => $request->f3_answers,
            'f4_link' => $request->f4_link,
            'f4_answers' => $request->f4_answers,
            'f5_answers' => $request->f5_answers,
            'student_data' => [
                'members' => $request->members,
            ],
        ]);

        if ($request->action == 'submit') {
            $group->update([
                'is_submitted' => true
            ]);

            return redirect()->route('student.complete', [
                $session_code,
                $group->id
            ])->with('success', 'Tugas dikirim!');
        }

        return back()->with('success', 'Progres berhasil disimpan!');
    }

    // Live check
    public function checkMemberName(Request $request)
    {
        $name = trim($request->name);
        $groupId = $request->group_id;

        $group = StudentGroup::with('session')->find($groupId);

        if (!$group || !$group->session) {
            return response()->json(['exists' => false]);
        }

        $teacherId = $group->session->user_id;

        $exists = StudentGroup::where('id', '!=', $groupId)
            ->whereHas('session', function($query) use ($teacherId) {
                $query->where('user_id', $teacherId);
            })
            ->where('student_data->members', 'LIKE', '%"' . $name . '"%')
            ->exists();

        return response()->json(['exists' => $exists]);
    }

    // Complete page
    public function complete($session_code, $group_id)
    {
        $session = Session::where('session_code', $session_code)->firstOrFail();

        $group = StudentGroup::with('evaluation')->findOrFail($group_id);

        if (!$group->is_submitted) {
            return redirect()->route('student.workspace', [$session_code, $group->id]);
        }

        return view('student.viewfeedback', compact('session', 'group'));
    }
}