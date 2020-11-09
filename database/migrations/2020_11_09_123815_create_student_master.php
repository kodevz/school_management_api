<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_master', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('class_id');
            $table->unsignedInteger('section_id');
            $table->string('admission_no', 30)->unique()->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('session');
            $table->tinyInteger('age')->nullable();
            $table->string('year_admitted')->nullable();
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
        Schema::dropIfExists('student_master');
    }
}
