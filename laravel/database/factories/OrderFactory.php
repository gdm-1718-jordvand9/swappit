<?php

use Faker\Generator as Faker;
use \App\Order;
use \App\User;

$factory->define(Order::class, function (Faker $faker) {
    $users = User::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($users),
        'price' => $faker->numberBetween(50,270),
        'status' => $faker->randomElement(['placed','payed','completed','cancelled']),
        'placed_at' => \Carbon\Carbon::now(),
    ];
});
