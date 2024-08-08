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
        Schema::create('system_files', function (Blueprint $table) {
            $table->id();
            $table->text('full_path')->nullable()->default(null);
            $table->unsignedBigInteger('reference_id')->nullable()->index()->comment('It can be a foreign key');
            $table->string('reference')->nullable()->index()->comment('It can be a table name');
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
        Schema::dropIfExists('system_files');
    }
};
