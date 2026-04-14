<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGroup extends Model
{
    use HasFactory;

    // Mendaftarkan kolom agar bisa diisi data (Mass Assignment)
    protected $fillable = [
        'session_id', 
        'group_name', 
        'student_data', 
        'class_name',
        'is_submitted',
        'f3_answers',
        'f4_link', 
        'f4_answers', 
        'f5_answers',
    ];

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
     * Relasi ke hasil evaluasi
     */
    public function evaluation()
    {
        // Menambahkan 'student_group_id' agar Laravel tidak bingung mencari foreign key-nya
        return $this->hasOne(Evaluation::class, 'student_group_id');
    }
}