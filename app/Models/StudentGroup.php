<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGroup extends Model
{
    use HasFactory;

    // 1. Daftarkan kolom agar bisa diisi data (Mass Assignment)
    protected $fillable = [
        'session_id', 
        'group_name', 
        'current_phase', 
        'student_data', 
        'is_submitted',
        'f3_answers', 
        'f4_code', 
        'f4_answers', 
        'f5_answers',
    ];

    // 2. Beritahu Laravel kalau student_data itu bentuknya Array/JSON
    protected $casts = [
        'student_data' => 'array',
        'is_submitted' => 'boolean',
        'current_phase' => 'integer',
        'f3_answers' => 'array',
        'f5_answers' => 'array'
    ];

    /**
     * Relasi balik ke Sesi PBL
     */
    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    /**
     * Relasi ke hasil evaluasi (Nilai)
     */
    public function evaluation()
    {
        // Tambahkan 'student_group_id' agar Laravel tidak bingung mencari foreign key-nya
        return $this->hasOne(Evaluation::class, 'student_group_id');
    }
}