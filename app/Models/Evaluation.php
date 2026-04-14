<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'student_group_id',
        'feedback_comment'
    ];

    public function group()
    {
        return $this->belongsTo(StudentGroup::class, 'student_group_id');
    }
}