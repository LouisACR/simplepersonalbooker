<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Meetings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->string('booker'); // nom du booker
            $table->string('booker_img'); //url
            $table->string('name'); // nom du meeting
            $table->string('description');
            $table->integer('duration'); // durée d'un meeting en minutes
            $table->integer('spacing'); // espacement des durées en minutes
            $table->json('recurring_off');
            $table->json('onetime_off');
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
        Schema::drop('meetings');
    }
}
