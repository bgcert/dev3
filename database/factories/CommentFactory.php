<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
    	'user_id' => \App\User::all()->random()->id,
        'body' => $faker->realText($faker->numberBetween(10, 60)),
    ];
});
