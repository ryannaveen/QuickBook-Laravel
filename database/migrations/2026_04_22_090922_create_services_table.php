<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
    Schema::create('services', function (Blueprint $table) {
        $table->id(); // Primary Key
        $table->foreignId('owner_id')->constrained('users')->onDelete('cascade'); // Link to Business Owner
        $table->string('service_name');
        $table->text('description')->nullable();
        $table->decimal('price', 10, 2); // Financial precision
        $table->timestamps(); // Tracks created_at and updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
