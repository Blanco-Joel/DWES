<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 

            $table->integer('emp_no');
            $table->integer('salary');
            $table->date('from_date');
            $table->date('to_date')->nullable();
            $table->primary(['emp_no', 'from_date']);
            $table->foreign('emp_no')->references('emp_no')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salaries');
    }
}
