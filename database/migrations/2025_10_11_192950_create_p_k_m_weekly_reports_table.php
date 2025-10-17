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
        Schema::create('p_k_m_weekly_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->date('week_start');
            $table->date('week_end');
            $table->integer('total_checked');
            $table->decimal('percentage', 5, 2);
            $table->foreign('student_id')->references('id')->on('p_k_m_students')->onDelete('cascade');
            $table->owners();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_k_m_weekly_reports');
    }
};
