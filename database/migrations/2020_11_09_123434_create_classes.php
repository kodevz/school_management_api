<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasses extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->unsignedInteger('class_type_id')->nullable();
            $table->timestamps();
        });

        Schema::table('classes', function (Blueprint $table) {
            $table->unique(['class_type_id', 'name']);
        });
    }
}
