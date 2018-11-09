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
            $table->string('event_id')->nullable();
            $table->integer('company_id')->unsigned();
            $table->string('theme_title')->nullable();
            $table->date('event_start_date')->nullable();
            $table->integer('event_price')->unsigned()->nullable();
            $table->string('contact_person');
            $table->string('contact_number');
            $table->string('contact_email');
            $table->text('comment')->nullable();
            $table->text('note')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->integer('status')->unsigned()->nullable();
            $table->boolean('paid')->default(0);
            $table->boolean('invoice')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
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
