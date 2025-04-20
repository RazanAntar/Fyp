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
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Event title
            $table->text('description'); // Detailed event description
            $table->dateTime('date_time'); // Date and time of the event
            $table->string('venue'); // Physical or virtual venue of the event
            $table->enum('type', ['physical', 'virtual'])->default('physical'); // Event type with default value
            $table->string('category'); // Event category (e.g., Workshop, Job Fair)
            $table->boolean('is_paid')->default(false); // Whether the event is free or paid
            $table->decimal('price', 8, 2)->nullable(); // Event price (nullable if free)
            $table->integer('max_participants')->nullable(); // Maximum number of participants
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events'); // Drop the table when rolling back
    }
};
