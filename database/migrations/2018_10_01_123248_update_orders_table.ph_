<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
        	$table->integer('user_id')->unsigned()->nullable()->change();
            $table->string('contact_email')->after('contact_number');
            $table->boolean('read')->default(0)->after('note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
        	$table->integer('user_id')->unsigned()->change();
            $table->dropColumn('contact_email');
            $table->dropColumn('read');
        });
    }
}
