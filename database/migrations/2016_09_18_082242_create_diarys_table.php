<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiarysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diarys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('breakfast');
            $table->string('lunch');
            $table->string('dinner');
            $table->string('other');
            $table->double('b_grains');
            $table->double('b_fruits');
            $table->double('b_vegetables');
            $table->double('b_dairy');
            $table->double('b_protein');
            $table->double('l_grains');
            $table->double('l_fruits');
            $table->double('l_vegetables');
            $table->double('l_dairy');
            $table->double('l_protein');
            $table->double('d_grains');
            $table->double('d_fruits');
            $table->double('d_vegetables');
            $table->double('d_dairy');
            $table->double('d_protein');
            $table->double('o_grains');
            $table->double('o_fruits');
            $table->double('o_vegetables');
            $table->double('o_dairy');
            $table->double('o_protein');
            $table->string('goal');
            $table->string('user_id');
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
        Schema::drop('diarys');
    }
}
