<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
	$event = \App\Event::all()->random();
    return [
        'user_id' => \App\User::all()->random()->id,
        'company_id' => $event->theme->company_id,
        'contact_person' => $faker->name,
        'contact_number' => $faker->e164PhoneNumber,
        'theme_title' => $event->theme->title,
        'event_begin_at' => $event->begin_at,
        'event_price' => $event->price,
        'invoice' => 0,
    ];
});