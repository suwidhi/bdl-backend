<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_cars', function (Blueprint $table) {
            $table->unsignedBigInteger('transaction');
            $table->foreign('transaction')->references('id')->on('transactions');
            $table->string('car', 30);
            $table->foreign('car')->references('vin')->on('cars');
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
        Schema::dropIfExists('transaction_cars');
    }
}
