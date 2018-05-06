<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->string('name');
            $table->string('image')->nullable();
            $table->mediumText('details');
            $table->timestamps();
        });

        Schema::create('event_teacher', function (Blueprint $table) {
        	$table->integer('event_id')->unsigned()->nullable()->index();
        	$table->foreign('event_id')->references('id')->on('events')->onDelete('set null')->onUpdate('cascade');

        	$table->integer('teacher_id')->unsigned()->nullable()->index();
        	$table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('set null')->onUpdate('cascade');

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
        Schema::dropIfExists('event_teacher');
        Schema::dropIfExists('teachers');
    }
}
