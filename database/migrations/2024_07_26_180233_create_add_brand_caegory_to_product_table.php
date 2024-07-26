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
        Schema::table('products', function (Blueprint $table) {

            $table->bigInteger('category_id')->unsigned()->nullable()->default(null)->comment("The ID of the category who created the record");
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('brand_id')->unsigned()->nullable()->default(null)->comment("The ID of the brand who created the record");
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('product_brand_id');
            $table->dropIndex('product_category_id');
            $table->dropColumn(['category_id', 'brand_id']);
        });
    }
};
