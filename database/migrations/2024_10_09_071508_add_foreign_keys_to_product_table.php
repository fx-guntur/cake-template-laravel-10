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
        Schema::table('product', function (Blueprint $table) {
            $table->foreign(['merchant_id'], 'FK__merchants_product')->references(['id'])->on('merchants')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['category_id'], 'FK_product_product_category')->references(['id'])->on('product_categories')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropForeign('FK__merchants_product');
            $table->dropForeign('FK_product_product_category');
        });
    }
};
