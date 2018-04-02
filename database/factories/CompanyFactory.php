<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'slug' => strtolower(str_random(7)),
        'description' => $faker->realText(),
        'logo' => 'https://picsum.photos/280/280/?image=' . $faker->numberBetween($min = 100, $max = 400),
        'cover' => 'https://picsum.photos/1200/800/?image=' . $faker->numberBetween($min = 100, $max = 400),
    ];
});
