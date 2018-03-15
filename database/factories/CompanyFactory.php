<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'slug' => strtolower(str_random(7)),
        'logo' => 'https://picsum.photos/240/280/?image=' . $faker->numberBetween($min = 100, $max = 1000),
        'cover' => 'https://picsum.photos/600/400/?image=' . $faker->numberBetween($min = 100, $max = 1000),
    ];
});
