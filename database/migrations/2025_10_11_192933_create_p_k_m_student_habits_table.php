<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('p_k_m_student_habits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('habit_id');
            $table->date('date');
            $table->boolean('is_checked')->default(false);
            $table->foreign('student_id')->references('id')->on('p_k_m_students')->onDelete('cascade');
            $table->foreign('habit_id')->references('id')->on('p_k_m_habits')->onDelete('cascade');
            $table->owners();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_k_m_student_habits');
    }
};
