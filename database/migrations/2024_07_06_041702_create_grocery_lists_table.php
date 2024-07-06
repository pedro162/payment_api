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
        Schema::create('grocery_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name', 300)->comment("Grocery list description");
            $table->decimal('total_gros_price', 60, 6)->nullable()->default(null)->comment('The total grocery list gross price');
            $table->decimal('total_discount_amount', 60, 6)->nullable()->default(null)->comment('The total applied discount');
            $table->decimal('total_net_price', 60, 6)->nullable()->default(null)->comment('The total grocery list net price');
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
        Schema::dropIfExists('grocery_lists');
    }
};
