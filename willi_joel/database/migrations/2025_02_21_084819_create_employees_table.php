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
            $table->engine = 'InnoDB'; 

            $table->integer('emp_no')->primary();
            $table->date('birth_date');
            $table->string('first_name',14);
            $table->string('last_name',20);
            $table->enum('gender',['M','F']);
            $table->date('hire_date');
            $table->date('baja')->nullable();
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

// :)
