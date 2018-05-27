<?php

use Faker\Generator as Faker;

$factory->define(App\Offer::class, function (Faker $faker) {
    return [
        'type' => $faker -> randomElement($array = array ('buy', 'seller')),
        'total' => $faker->numberBetween($min = 1, $max = 10000),
        'commission' => $faker->numberBetween($min = 1, $max = 10000),
        'payment' => $faker->numberBetween($min = 1, $max = 10000),
        'transaction_number' => $faker->numberBetween($min = 1, $max = 10000),
        'user_id' => 1,
    ];
});
