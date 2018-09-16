<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('event_id')->nullable();
            $table->integer('company_id')->unsigned();
            $table->string('theme_title')->nullable();
            $table->date('event_start_date')->nullable();
            $table->integer('event_price')->unsigned()->nullable();
            $table->string('contact_person');
            $table->string('contact_number');
            $table->text('comment')->nullable();
            $table->text('note')->nullable();
            $table->integer('status')->unsigned()->nullable();
            $table->boolean('paid')->default(0);
            $table->boolean('invoice')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
