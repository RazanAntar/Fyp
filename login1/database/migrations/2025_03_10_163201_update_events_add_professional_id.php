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
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'professional_id')) {
                $table->unsignedBigInteger('professional_id')->nullable()->after('id');
                $table->foreign('professional_id')->references('id')->on('professionals');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['professional_id']);
            $table->dropColumn('professional_id');

        });
    }
};
