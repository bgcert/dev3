<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'slug' => strtolower(str_random(7)),
        'logo' => 'https://placeimg.com/240/280/any?t=' . $faker->numberBetween($min = 100, $max = 1000),
        'cover' => 'https://placeimg.com/640/480/any?t=' . $faker->numberBetween($min = 100, $max = 1000),
    ];
});
