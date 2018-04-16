<?php

use Faker\Generator as Faker;

$factory->define(App\Venue::class, function (Faker $faker) {
    return [
        'company_id' => \App\Company::all()->random()->id,
        'name' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'description' => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
        'capacity' => $faker->numberBetween($min = 10, $max = 100),
        'cover' => 'https://picsum.photos/800/400/?image=' . $faker->numberBetween($min = 100, $max = 400),
    ];
});
