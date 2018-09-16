<?php

use Faker\Generator as Faker;
use \App\Ticket;
use \App\User;
use \App\TicketType;
use Carbon\Carbon;
use App\Order;
use \Illuminate\Support\Facades\Crypt;

$factory->define(Ticket::class, function (Faker $faker) {

    $users = User::pluck('id')->toArray();
    $tickettypes = TicketType::pluck('id')->toArray();
    $orders = Order::pluck('id')->toArray();
    return [
        'price' => $faker->numberBetween(10,270),
        'sold' => $faker->boolean,
        'published' => $faker->boolean,
        'start_date' => date('Y-m-d'),
        'end_date' => date('Y-m-d'),
        'bump_date' => Carbon::now(),
        'ticket_type_id' => $faker->randomElement($tickettypes),
        'user_id' => $faker->randomElement($users),
        'order_id' => $faker->randomElement([$faker->randomElement($orders),null]),
        'code' => Crypt::encryptString(str_random(20)),
    ];
});
