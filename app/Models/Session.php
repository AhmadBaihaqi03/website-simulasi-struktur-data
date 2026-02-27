<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Session extends Model
{
    use HasFactory;

    protected $table = 'pbl_sessions'; 

    protected $fillable = [
        'user_id', 
        'session_code', 
        'title', 
        'is_active', 
        'f1_context', 
        'f3_questions',
        'f5_questions',
        'f1_learning_objectives',
        'f4_instruction', 
        'f4_question'
    ];

    protected $casts = [
        'f3_questions' => 'array',
        'f5_questions' => 'array',
        'f1_learning_objectives' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Relasi ke Guru (User)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Kelompok Murid
     */
    public function groups()
    {
        return $this->hasMany(StudentGroup::class, 'session_id');
    }

    public function getPendingEvaluationsCountAttribute()
    {
        // Menghitung kelompok yang sudah submit tapi belum ada di tabel evaluations
        return $this->groups()
                    ->where('is_submitted', true)
                    ->whereDoesntHave('evaluation')
                    ->count();
    }
}