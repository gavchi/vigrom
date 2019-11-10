<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    $date = $faker->dateTimeInInterval('-10 days');

    return [
        'currency_id' => $faker->numberBetween(1, 2),
        'amount' => round($faker->randomFloat(6, 0, 100000), 2),
        'type' => $faker->randomElement(['debit', 'credit', 'credit', 'credit']), //для большей вероятности + на балансе
        'cause' => $faker->randomElement(['stock', 'gift', 'refund']),
        'created_at' => $date,
        'updated_at' => $date,
    ];
});
