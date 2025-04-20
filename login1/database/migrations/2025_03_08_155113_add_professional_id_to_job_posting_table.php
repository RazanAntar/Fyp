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
            $table->unsignedBigInteger('professional_id')->after('id'); // assuming 'id' is a column in your table
            $table->foreign('professional_id')->references('id')->on('professionals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_posting', function (Blueprint $table) {
            $table->dropForeign(['professional_id']);
            $table->dropColumn('professional_id');
        });
    }
};
