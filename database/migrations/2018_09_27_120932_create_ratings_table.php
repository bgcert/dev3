<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rating');
            $table->morphs('rateable');
            $table->unsignedInteger('user_id')->index();
            $table->index('rateable_id');
            $table->index('rateable_type');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('average_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rateable_id')->unsigned();
            $table->string('rateable_type');
            $table->integer('rating')->unsigned()->default(0);
            $table->unique(['rateable_id', 'rateable_type']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
    	Schema::drop('average_ratings');
        Schema::drop('ratings');
    }
}
