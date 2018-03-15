<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'theme_id' => \App\Theme::all()->random()->id,
        'test' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'cover' => 'https://placeimg.com/640/480/any?t=' . $faker->numberBetween($min = 100, $max = 1000),
        'begin_at' => $faker->dateTimeBetween($startDate = 'now', $interval = '+ 200 days'),
        'end_at' => $faker->dateTimeBetween($startDate = 'now', $interval = '+ 200 days'),
    ];
});
