<?php

use Faker\Generator as Faker;

$factory->define(App\Teacher::class, function (Faker $faker) {
    return [
    	'company_id' => \App\Company::all()->random()->id,
        'name' => $faker->name,
        'image' => 'https://picsum.photos/400/400/?image=' . $faker->numberBetween($min = 100, $max = 400),
        'details' => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
    ];
});
