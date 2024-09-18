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
        Schema::create('customers', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('uuid', 36)->unique(); // Ensure UUID is unique
            $table->string('name', 50);
            $table->string('phone', 15);
            $table->string('email')->unique(); // Ensure email is unique
            $table->string('username', 50)->unique(); // Ensure username is unique
            $table->string('password');
            $table->string('raw_password')->nullable(); // Make raw_password nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
