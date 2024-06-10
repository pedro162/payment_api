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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name', 600)->comment("Person name");
            $table->string('document', 255)->nullable(true)->comment("Document person, EX: ID, TIN");
            $table->enum('person_type', ['np', 'lp'])->default('np')->comment("np: Natural Person, lp: Ligal Person");
            $table->bigInteger('users_create_id')->unsigned()->nullable()->default(null)->comment("The ID of the person that created the register");
            $table->foreign('users_create_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('users_update_id')->unsigned()->nullable()->default(null)->comment("The ID of the person that update the register");
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
        Schema::dropIfExists('people');
    }
};
