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
        Schema::create('transactions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('uuid', 36);
            $table->integer('merchant_id')->index('fk__merchants_payment');
            $table->integer('customer_id')->index('fk__customers_payment');
            $table->integer('payment_id');
            $table->string('payment_code', 50);
            $table->string('invoice');
            $table->string('type', 50);
            $table->double('amount', null, 0);
            $table->double('unique_code', null, 0);
            $table->double('charge', null, 0);
            $table->dateTime('transaction_date');
            $table->dateTime('transaction_paid_date');
            $table->dateTime('transaction_deadline');
            $table->enum('status', ['complete', 'pending', 'cancel'])->default('pending');
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
        Schema::dropIfExists('transactions');
    }
};
