<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('code', 100)->unique();
            $table->string('username', 100)->nullable()->unique();
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('image_url')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->string('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->dropColumn('username');
            $table->dropColumn('dob');
            $table->dropColumn('gender');
            $table->dropColumn('image_url');
            $table->dropColumn('phone');
            $table->dropColumn('city_id');
            $table->dropColumn('address');
        });
    }
}
