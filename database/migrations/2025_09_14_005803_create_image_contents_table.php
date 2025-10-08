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
        Schema::create('image_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('content_invitations_id');
            $table->integer('sort');
            $table->string('name', 1000);
            $table->owners();

            $table->foreign('content_invitations_id')->references('id')->on('content_invitations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_contents');
    }
};
