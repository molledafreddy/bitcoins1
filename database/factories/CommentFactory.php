<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'comment' => $faker->text,
        'status' => $faker -> randomElement($array = array ('si', 'no')),
    ];
});
