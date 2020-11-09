<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_master_id');
            $table->unsignedInteger('subject_id');
            $table->unsignedInteger('class_id');
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('exam_id');
            $table->integer('mark1')->nullable();
            $table->integer('mark2')->nullable();
            $table->integer('mark3')->nullable();
            $table->integer('total_mark')->nullable();
            $table->unsignedInteger('grade_id')->nullable();
            $table->string('year');
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
        Schema::dropIfExists('marks');
    }
}
