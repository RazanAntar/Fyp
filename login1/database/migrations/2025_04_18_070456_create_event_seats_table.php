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
        Schema::create('event_seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('seat_number'); // e.g., A1, A2, B1, etc.
            $table->morphs('occupant'); // occupant_id + occupant_type (User or Professional)
            $table->timestamps();
        
            $table->unique(['event_id', 'seat_number']); // prevent duplicate seats
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_seats');
    }
};
