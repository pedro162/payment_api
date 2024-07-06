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
        Schema::create('grocery_list_items', function (Blueprint $table) {
            $table->id();
            $table->decimal('quantity', 60, 6)->nullable()->default(null)->comment('The product quantity');
            $table->decimal('unit_gross_price', 60, 6)->nullable()->default(null)->comment('The unit product gross price');
            $table->decimal('total_gros_price', 60, 6)->nullable()->default(null)->comment('The total product gross price');
            $table->decimal('unit_net_price', 60, 6)->nullable()->default(null)->comment('The unit product net price');
            $table->decimal('total_net_price', 60, 6)->nullable()->default(null)->comment('The total product net price');
            $table->decimal('unit_discount_amount', 60, 6)->nullable()->default(null)->comment('The unit applied discount');
            $table->decimal('total_discount_amount', 60, 6)->nullable()->default(null)->comment('The total applied discount');
            $table->bigInteger('grocery_list_id')->unsigned()->comment('The ID of the related grocery list');
            $table->foreign('grocery_list_id')->references('id')->on('grocery_lists')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('product_id')->unsigned()->comment('The ID of the related product');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('users_create_id')->unsigned()->nullable()->default(null)->comment("The ID of the person who created the record");
            $table->foreign('users_create_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('users_update_id')->unsigned()->nullable()->default(null)->comment("The ID of the person who updated the record");
            $table->foreign('users_update_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grocery_list_items');
    }
};
