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
        Schema::table('job_posting', function (Blueprint $table) {
            Schema::table('job_posting', function (Blueprint $table) {
                $table->string('experience_level', 100)->change();  // Increasing the length
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_posting', function (Blueprint $table) {
            $table->string('experience_level', 50)->change();  // Reverting the change
        });
    }
};
