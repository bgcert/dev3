<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::all()->random()->id,
        'event_id' => \App\Event::all()->random()->id,
        'invoice' => $faker->numberBetween($min = 0, $max = 1),
    ];
});