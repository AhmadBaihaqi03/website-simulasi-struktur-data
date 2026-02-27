<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\StudentGroup;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // 1. Ambil data sesi untuk tabel (Eager Loading count agar tidak lambat)
        $sessions = Session::where('user_id', $user->id)
            ->withCount('groups')
            ->latest()
            ->get();

        // 2. Hitung statistik untuk 6 Card
        $stats = [
            // Baris Sesi
            'total'  => $sessions->count(),
            'active' => $sessions->where('is_active', true)->count(),
            
            // Baris Grup & Evaluasi
            // Total semua grup yang ada di bawah naungan guru ini
            'total_groups' => StudentGroup::whereHas('session', function($query) use ($user) {
                                $query->where('user_id', $user->id);
                             })->count(),

            // Kelompok yang sudah submit TAPI belum dinilai
            'pending' => StudentGroup::whereHas('session', function($query) use ($user) {
                                $query->where('user_id', $user->id);
                             })
                             ->where('is_submitted', true)
                             ->whereDoesntHave('evaluation') // Asumsi relasi ke tabel penilaian namanya 'evaluation'
                             ->count(),

            // Kelompok yang sudah selesai dinilai
            'graded' => StudentGroup::whereHas('session', function($query) use ($user) {
                                $query->where('user_id', $user->id);
                             })
                             ->whereHas('evaluation')
                             ->count(),
        ];

        return view('dashboard', compact('sessions', 'stats'));
    }
}