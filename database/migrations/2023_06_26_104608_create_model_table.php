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
        Schema::create('model_bike', function (Blueprint $table) {
            $table->id('id_model_bike');
            $table->unsignedBigInteger('id_manufacturer');
            $table->foreign('id_manufacturer')->references('id_manufacturer')->on('manufacturer');
            $table->unsignedBigInteger('id_engine');
            $table->foreign('id_engine')->references('id_engine')->on('engine');
            $table->string('name');
            $table->integer('year_model');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model');
    }
};
