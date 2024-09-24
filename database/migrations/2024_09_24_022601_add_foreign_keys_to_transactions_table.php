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
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign(['customer_id'], 'FK__customers_payment')->references(['id'])->on('customers')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['merchant_id'], 'FK__merchants_payment')->references(['id'])->on('merchants')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign('FK__customers_payment');
            $table->dropForeign('FK__merchants_payment');
        });
    }
};
