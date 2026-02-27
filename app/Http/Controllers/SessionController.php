<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use Illuminate\Support\Str;

class SessionController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'f3_questions' => 'nullable|array',
            'f5_questions' => 'nullable|array',
            'f1_learning_objectives' => 'nullable|array',
        ]);

        $request->user()->sessions()->create([ 
            'session_code'   => strtoupper(Str::random(6)),
            'title'          => $request->title,
            'f1_context'     => $request->f1_context,
            'f3_questions'   => $request->f3_questions,
            'f5_questions'   => $request->f5_questions,
            'f1_learning_objectives' => $request->f1_learning_objectives,
            'f4_instruction' => $request->f4_instruction,
            'f4_question'    => $request->f4_question,
            'is_active'      => true,
        ]);

        return redirect()->route('dashboard')->with('success', 'Sesi berhasil dibuat!');
    }

    public function edit(Session $session)
    {
        // Proteksi: Pastikan hanya pemilik yang bisa edit
        // if ($session->user_id !== auth()->id()) { abort(403); } -> sementara baris yang seperti ini aku komen dulu

        return view('sessions.edit', compact('session'));
    }

    public function update(Request $request, Session $session)
    {
        //if ($session->user_id !== auth()->id()) { abort(403); } -> sementara baris yang seperti ini aku komen dulu

        $request->validate([
            'title' => 'required|string|max:255',
            'f3_questions' => 'nullable|array',
            'f5_questions' => 'nullable|array',
            'f1_learning_objectives' => 'nullable|array',
        ]);

        $session->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Sesi diperbarui!');
    }

    public function toggle(Session $session)
    {
        //if ($session->user_id !== auth()->id()) { abort(403); } -> sementara baris yang seperti ini aku komen dulu

        $session->update(['is_active' => !$session->is_active]);
        
        $status = $session->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Sesi berhasil $status!");
    }

    public function destroy(Session $session)
    {
        //if ($session->user_id !== auth()->id()) { abort(403); } -> sementara baris yang seperti ini aku komen dulu

        $session->delete();
        return back()->with('success', 'Sesi berhasil dihapus!');
    }

    public function evaluations(Session $session)
    {
        // Proteksi keamanan: Pastikan guru yang login adalah pemilik sesi
        //if ($session->user_id !== auth()->id()) { abort(403);} -> sementara baris yang seperti ini aku komen dulu

        // Load data kelompok (student_groups) yang terhubung dengan sesi ini
        // Kita gunakan eager loading 'groups' agar lebih cepat
        $session->load('groups');

        return view('sessions.evaluation', compact('session')); 
    }
}