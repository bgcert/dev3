<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->string('ip_address')->nullable();
            $table->integer('visitable_id')->unsigned();
            $table->string('visitable_type');
            $table->unique(['visitable_id', 'visitable_type', 'ip_address']);
            $table->timestamps();
        });

        Schema::create('visit_counts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visitable_id')->unsigned();
            $table->string('visitable_type');
            $table->integer('count')->unsigned()->default(0);
            $table->unique(['visitable_id', 'visitable_type']);
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
        Schema::dropIfExists('visits');
        Schema::dropIfExists('visit_counts');
    }
}
