<?php

use Faker\Generator as Faker;

$factory->define(App\VenueImage::class, function (Faker $faker) {
    return [
        'filename' => 'https://picsum.photos/600/400/?image=' . $faker->numberBetween($min = 100, $max = 1000),
    ];
});
