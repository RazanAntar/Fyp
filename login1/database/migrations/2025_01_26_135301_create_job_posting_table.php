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
        Schema::create('job_posting', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Job title
            $table->string('company'); // Company name
            $table->string('location'); // Location of the job
            $table->enum('type', ['full-time', 'part-time', 'contract', 'internship', 'freelance']); // Job type
            $table->enum('experience_level', ['entry', 'mid', 'senior', 'intern']); // Experience level
            $table->string('category')->default('General'); // Category/Industry with a default value
            $table->integer('salary')->nullable(); // Salary, can be null
            $table->boolean('remote')->default(false); // Whether the job is remote
            $table->text('description')->nullable(); // Additional details about the job
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posting');
    }
};
