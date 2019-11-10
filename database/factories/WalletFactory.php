<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Wallet;
use Faker\Generator as Faker;

$factory->define(Wallet::class, function (Faker $faker) {
    return [
        'currency_id' => $faker->numberBetween(1, 3),
        'balance' => round($faker->randomFloat(6, 0, 100000), 2),
    ];
});
