<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'theme_id' => \App\Theme::all()->random()->id,
        'price' => $faker->randomNumber(3),
        'begin_at' => $faker->dateTimeBetween($startDate = 'now', $interval = '+ 200 days'),
        'end_at' => $faker->dateTimeBetween($startDate = 'now', $interval = '+ 200 days'),
    ];
});
