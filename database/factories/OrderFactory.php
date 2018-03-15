<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::all()->random()->id,
        'event_id' => \App\Event::all()->random()->id,
        'qty' => $faker->numberBetween($min = 1, $max = 10),
        'invoice' => $faker->numberBetween($min = 0, $max = 1),
    ];
});