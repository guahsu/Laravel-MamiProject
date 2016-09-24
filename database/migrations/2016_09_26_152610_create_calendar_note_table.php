<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_note', function (Blueprint $table) {
            $table->increments('id');
            $table->string('week');
            $table->string('title');
            $table->text('content1');
            $table->text('content2');
            $table->text('content3');
            $table->text('content4');
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
        Schema::drop('calendar_note');
    }
}
