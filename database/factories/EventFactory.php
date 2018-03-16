<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'theme_id' => \App\Theme::all()->random()->id,
        'cover' => 'https://picsum.photos/600/400/?image=' . $faker->numberBetween($min = 100, $max = 1000),
        'begin_at' => $faker->dateTimeBetween($startDate = 'now', $interval = '+ 200 days'),
        'end_at' => $faker->dateTimeBetween($startDate = 'now', $interval = '+ 200 days'),
    ];
});
