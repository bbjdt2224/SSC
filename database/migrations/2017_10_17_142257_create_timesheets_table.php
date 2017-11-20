<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('timesheets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->date('startdate');
            $table->string('totals')->default('0,0,0');
            $table->boolean('submitted')->default('0');
            $table->binary('signature')->nullable();
            $table->timestamps();
        });

        Schema::table('timesheets', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timesheets', function(Blueprint $table){
            $table->dropForeign('user_id');
        });
        Schema::dropIfExists('timesheets');
    }
}
