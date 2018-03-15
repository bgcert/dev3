<?php

use Faker\Generator as Faker;

$factory->define(App\VenueImage::class, function (Faker $faker) {
    return [
        'venue_id' => \App\Venue::all()->random()->id,
        'filename' => 'https://placeimg.com/640/480/any?t=' . $faker->numberBetween($min = 100, $max = 1000),
    ];
});
