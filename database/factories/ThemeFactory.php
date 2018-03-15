<?php

use Faker\Generator as Faker;

$factory->define(App\Theme::class, function (Faker $faker) {
    return [
    	'company_id' => \App\Company::all()->random()->id,
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'body' => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
        'cover' => 'https://picsum.photos/600/400/?image=' . $faker->numberBetween($min = 100, $max = 1000),
    ];
});
