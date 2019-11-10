<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_number');
            $table->string('name');
            $table->string('gender');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('religion');
            $table->string('address');
            $table->string('ex_school');
            $table->string('ex_school_address');
            $table->integer('date_received');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('parents_phone');
            $table->string('parents_address');
            $table->string('guardian_name');
            $table->string('guardian_address');
            $table->string('guardian_phone');
            $table->bigInteger('departments_id');
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
        Schema::dropIfExists('students');
    }
}
