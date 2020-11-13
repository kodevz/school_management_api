<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
			$table->softDeletes();
		});

        Schema::table('subjects', function(Blueprint $table) {
			$table->softDeletes();
		});

        Schema::table('student_master', function(Blueprint $table) {
			$table->softDeletes();
		});

        Schema::table('staff_master', function(Blueprint $table) {
			$table->softDeletes();
		});

        Schema::table('sections', function(Blueprint $table) {
			$table->softDeletes();
		});

        Schema::table('marks', function(Blueprint $table) {
			$table->softDeletes();
		});

        Schema::table('grades', function(Blueprint $table) {
			$table->softDeletes();
		});

        Schema::table('exams', function(Blueprint $table) {
			$table->softDeletes();
		});

        Schema::table('exam_records', function(Blueprint $table) {
			$table->softDeletes();
		});

        Schema::table('classes', function(Blueprint $table) {
			$table->softDeletes();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropSoftDeletes();
		});

        Schema::table('subjects', function(Blueprint $table){
            $table->dropSoftDeletes();
		});

        Schema::table('student_master', function(Blueprint $table){
            $table->dropSoftDeletes();
		});

        Schema::table('staff_master', function(Blueprint $table){
            $table->dropSoftDeletes();
		});
        
        Schema::table('sections', function(Blueprint $table){
            $table->dropSoftDeletes();
		});

        Schema::table('marks', function(Blueprint $table){
            $table->dropSoftDeletes();
		});

        Schema::table('grades', function(Blueprint $table){
            $table->dropSoftDeletes();
		});

        Schema::table('exams', function(Blueprint $table){
            $table->dropSoftDeletes();
		});

        Schema::table('exam_records', function(Blueprint $table){
            $table->dropSoftDeletes();
		});

        Schema::table('classes', function(Blueprint $table){
            $table->dropSoftDeletes();
		});
    }
}
