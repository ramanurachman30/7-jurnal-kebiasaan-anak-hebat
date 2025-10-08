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
        Schema::create('content_invitations', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->unsignedBigInteger('wedding_id');
            $table->unsignedBigInteger('template_id');
            $table->string('daughter', 100);
            $table->string('son', 100);
            $table->string('bride_father', 100);
            $table->string('bride_mother', 100);
            $table->string('groom_father', 100);
            $table->string('groom_mother', 100);
            $table->date('bride_date');
            $table->date('groom_date');
            $table->text('forewords');
            $table->owners();

            $table->foreign('wedding_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_invitations');
    }
};
