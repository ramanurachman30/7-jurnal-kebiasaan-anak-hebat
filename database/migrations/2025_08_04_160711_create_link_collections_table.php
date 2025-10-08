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
        Schema::create('link_collections', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->longText('image')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('link');
            $table->longText('tooltip_text')->nullable();
            $table->integer('ordering')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_collections');
    }
};
