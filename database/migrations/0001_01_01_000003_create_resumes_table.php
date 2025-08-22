<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('template')->default('modern');
            $table->json('personal_info');
            $table->json('education');
            $table->json('experience');
            $table->json('skills');
            $table->json('certifications')->nullable();
            $table->json('social_links')->nullable();
            $table->json('additional_sections')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
