<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee');
            $table->foreign('employee')->references('id')->on('employees');
            $table->unsignedBigInteger('dealer');
            $table->foreign('dealer')->references('id')->on('dealers');
            $table->unsignedBigInteger('type');
            $table->foreign('type')->references('id')->on('transaction_types');
            $table->unsignedBigInteger('model');
            $table->foreign('model')->references('id')->on('car_models');
            $table->integer('amount');
            $table->unsignedBigInteger('status');
            $table->foreign('status')->references('id')->on('transaction_statuses');
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
        Schema::dropIfExists('transactions');
    }
}
