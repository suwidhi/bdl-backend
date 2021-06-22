<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->string('vin', 30);
            $table->primary('vin');
            $table->unsignedBigInteger('brand');
            $table->foreign('brand')->references('id')->on('brands');
            $table->unsignedBigInteger('type');
            $table->foreign('type')->references('id')->on('car_types');
            $table->unsignedBigInteger('model');
            $table->foreign('model')->references('id')->on('car_models');
            $table->unsignedBigInteger('option');
            $table->foreign('option')->references('id')->on('car_options');
            $table->float('price', 32, 2);
            $table->boolean('transfered')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
