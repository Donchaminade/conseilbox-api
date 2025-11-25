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
        Schema::create('conseils', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->text('anecdote')->nullable();
            $table->string('author');
            $table->string('location')->nullable();
            $table->string('status')->default('pending');
            $table->string('social_link_1')->nullable();
            $table->string('social_link_2')->nullable();
            $table->string('social_link_3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conseils');
    }
};
