<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pbl_sessions', function (Blueprint $table) { 
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('session_code')->unique();
            $table->string('title');
            $table->boolean('is_active')->default(true);
            $table->text('f1_context')->nullable();             // Scenario Narrative
            $table->json('f1_learning_objectives')->nullable(); // learning objectives
            $table->json('f3_questions')->nullable();           // Phase 03: Investigation Tasks
            $table->json('f5_questions')->nullable();           // Phase 05: Reflection Questions 
            $table->text('f4_instruction')->nullable();         // Phase 04: Instruction
            $table->text('f4_question')->nullable();            // Phase 04: Descrition System Question
            $table->timestamps(); 
        });
        
        Schema::create('student_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('pbl_sessions')->onDelete('cascade');
            $table->string('group_name');
            $table->integer('current_phase')->default(1);
            $table->json('student_data');                       // Menyimpan data siswa dalam format JSON (nama, no absen, dll) 
            $table->json('f3_answers')->nullable();             // Jawaban Fase 3 (JSON Array)
            $table->text('f4_code')->nullable();                // Kode Program atau Deskripsi Fase 4
            $table->text('f4_answers')->nullable();             // Jawaban Fase 4
            $table->json('f5_answers')->nullable();             // Jawaban Refleksi Fase 5 (JSON Array)
            $table->boolean('is_submitted')->default(false);
            $table->timestamps();
        });

        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            // Pastikan foreignId merujuk ke tabel yang benar
            $table->foreignId('student_group_id')->constrained('student_groups')->onDelete('cascade');
            $table->integer('score');
            $table->text('feedback_comment')->nullable();
            $table->timestamps();
        });
    }
};