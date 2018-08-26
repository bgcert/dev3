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
            ['name' => 'Бизнес и продажби', 'slug' => 'business-sales', 'cover' => 'business.png'],
            ['name' => 'Маркетинг и комуникации', 'slug' => 'marketing-communications', 'cover' => 'marketing.png'],
            ['name' => 'IT и Софтуер', 'slug' => 'it-software', 'cover' => 'it.png'],
            ['name' => 'Счетоводство и финанси', 'slug' => 'accounting-finance', 'cover' => 'finance.png'],
            ['name' => 'Законодателство', 'slug' => 'law', 'cover' => 'legislation.png'],
            ['name' => 'Туризъм и ресторантьорство', 'slug' => 'Tourism and catering', 'cover' => 'catering.png'],
            ['name' => 'Креативни изкуства и дизайн', 'slug' => 'art-design', 'cover' => 'art.png'],
            ['name' => 'Личностно развитие', 'slug' => 'personal-development', 'cover' => 'personal-developement.png'],
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
