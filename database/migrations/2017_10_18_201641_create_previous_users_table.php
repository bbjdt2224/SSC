<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreviousUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previous_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('oldid');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('fundcc');
            $table->text('jobcode');
            $table->boolean('admin')->default('0');
            $table->integer('hours')->default('0');
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
        Schema::dropIfExists('previous_users');
    }
}
