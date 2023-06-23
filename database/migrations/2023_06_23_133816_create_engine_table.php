<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engine', function (Blueprint $table) {
            $table->id('id_engine');
            $table->unsignedBigInteger('id_engine_type');
            $table->foreign('id_engine_type')->references('id_engine_type')->on('engine_type');
            $table->string('name');
            $table->integer('capacity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('engine');
    }
};
