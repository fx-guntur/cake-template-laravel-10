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
        Schema::create('transaction_metas', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('uuid', 36);
            $table->integer('transaction_id')->index('fk__transactions');
            $table->string('key', 50);
            $table->text('value');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->softDeletes()->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_metas');
    }
};
