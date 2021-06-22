<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('type');
            $table->foreign('type')->references('id')->on('employee_types');
            $table->unsignedBigInteger('dealer');
            $table->foreign('dealer')->references('id')->on('dealers');
            $table->string('name', 120);
            $table->string('email', 60);
            $table->string('phone', 15);
            $table->timestamp('working_date');
            $table->mediumText('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
