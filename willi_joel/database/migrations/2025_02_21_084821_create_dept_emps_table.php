<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeptEmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dept_emps', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 

            $table->integer('emp_no');
            $table->char('dept_no', 4);
            $table->date('from_date');
            $table->date('to_date')->nullable();
            $table->primary(['emp_no', 'dept_no', 'from_date']);
            $table->foreign('emp_no')->references('emp_no')->on('employees')->onDelete('cascade');
            $table->foreign('dept_no')->references('dept_no')->on('departments')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dept_emps');
    }
}
