<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('likable_id')->unsigned();
            $table->string('likable_type');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('like_counts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('likeable_id', 36);
			$table->string('likeable_type', 255);
			$table->integer('count')->unsigned()->default(0);
			$table->unique(['likeable_id', 'likeable_type'], 'like_counts');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
        Schema::dropIfExists('like_counts');
    }
}