<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 36);
			$table->string('slug', 36);
			$table->string('cover')->nullable();
			$table->timestamps();
		});

		DB::table('categories')->insert([
            ['name' => 'Бизнес и продажби', 'slug' => 'business-sales'],
            ['name' => 'Маркетинг и комуникации', 'slug' => 'marketing-communications'],
            ['name' => 'IT и Софтуер', 'slug' => 'it-software'],
            ['name' => 'Счетоводство и финанси', 'slug' => 'accounting-finance'],
            ['name' => 'Сертификация и стандарти', 'slug' => 'certification'],
            ['name' => 'Закони и регламенти', 'slug' => 'legislation'],
            ['name' => 'Туризъм и ресторантьорство', 'slug' => 'Tourism and catering'],
            ['name' => 'Креативни изкуства и дизайн', 'slug' => 'art-design'],
            ['name' => 'Личностно развитие', 'slug' => 'personal-development'],
            ['name' => 'Езиково обучение', 'slug' => 'language'],
        ]);

        Schema::create('themes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('title');
            $table->text('excerpt');
            $table->text('body');
            $table->string('cover')->nullable();
            $table->text('duration');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('themes');
        Schema::dropIfExists('categories');
    }
}
