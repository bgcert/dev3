<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'theme_id' => \App\Theme::all()->random()->id,
        'cover' => 'https://picsum.photos/800/400/?image=' . $faker->numberBetween($min = 100, $max = 400),
        'begin_at' => $faker->dateTimeBetween($startDate = 'now', $interval = '+ 200 days'),
        'end_at' => $faker->dateTimeBetween($startDate = 'now', $interval = '+ 200 days'),
    ];
});
