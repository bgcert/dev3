<?php

use Faker\Generator as Faker;

$factory->define(App\Teacher::class, function (Faker $faker) {
    return [
    	'company_id' => \App\Company::all()->random()->id,
        'name' => $faker->name,
        'details' => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
    ];
});
