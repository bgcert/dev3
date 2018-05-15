<?php

use Faker\Generator as Faker;

$factory->define(App\CompanyDetail::class, function (Faker $faker) {
    return [
        'description' => $faker->realText(),
        'logo' => 'https://picsum.photos/280/280/?image=' . $faker->numberBetween($min = 100, $max = 400),
        'cover' => 'https://picsum.photos/1200/800/?image=' . $faker->numberBetween($min = 100, $max = 400),
    ];
});
