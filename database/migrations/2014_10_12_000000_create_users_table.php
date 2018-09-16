<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned()->default(1);
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('token')->nullable();
            $table->string('picture')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        DB::table('users')->insert(array(
        	array(
        		'role_id' => 3,
		        'firstname' => 'Чавдар',
		        'lastname' => 'Ангелов',
		        'email' => 'info@seminari365.com',
		        'password' => Hash::make('password'),
		        'token' => null
        	),
        	array(
        		'role_id' => 3,
		        'firstname' => 'Петър',
		        'lastname' => 'Петров',
		        'email' => 'bgcert.training@gmail.com',
		        'password' => Hash::make('password'),
		        'token' => null
        	),
        	array(
        		'role_id' => 2,
		        'firstname' => 'Тест',
		        'lastname' => 'Акаунт',
		        'email' => 'test@seminari365.com',
		        'password' => Hash::make('password'),
		        'token' => null
        	),
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
