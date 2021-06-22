<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->string('code', 60);
            $table->primary('code');
            $table->unsignedBigInteger('supplier')->nullable();
            $table->foreign('supplier')->references('id')->on('suppliers');
            $table->unsignedBigInteger('manufacturer')->nullable();
            $table->foreign('manufacturer')->references('id')->on('manufacturers');
            $table->unsignedBigInteger('model');
            $table->foreign('model')->references('id')->on('car_models');
            $table->string('name', 120);
            $table->longText('description');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parts');
    }
}
