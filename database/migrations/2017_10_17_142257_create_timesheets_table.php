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
         $defaultString = "-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0";
            $table->increments('id');
            $table->string('user');
            $table->date('startdate');
            $table->string('firstweek')->default($defaultString);
            $table->string('secondweek')->default($defaultString);
            $table->string('totals')->default('0,0,0');
            $table->boolean('submitted')->default('0');
            $table->binary('signature')->nullable();
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
        Schema::dropIfExists('timesheets');
    }
}
