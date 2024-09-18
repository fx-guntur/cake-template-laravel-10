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
        Schema::create('merchant_meta', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('uuid', 36);
            $table->integer('merchant_id')->index('fk__merchants');
            $table->string('key', 50);
            $table->text('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_meta');
    }
};
