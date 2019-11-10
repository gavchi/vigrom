<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Exchange;
use Faker\Generator as Faker;

$factory->define(Exchange::class, function (Faker $faker) {
    $currencies = [1, 2];
    $currency_from = $faker->randomElement($currencies);
    $currency_to = $faker->randomElement(array_diff($currencies, [$currency_from]));
    $date = $faker->dateTimeInInterval('-10 days');

    return [
        'currency_from' => $currency_from,
        'currency_to' => $currency_to,
        'multiplier' => round($faker->randomFloat(6, 0, 5), 4),
        'created_at' => $date,
        'updated_at' => $date,
    ];
});
