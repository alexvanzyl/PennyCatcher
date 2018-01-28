<?php

use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    return [
        'budget_subcategory_id' => factory(\App\BudgetSubcategory::class)->create()->id,
        'type' => $faker->randomElement(['income', 'expense']),
        'description' => $faker->text,
        'amount' => $faker->randomFloat(2, 1, 5000),
        'transaction_date' => $faker->dateTime(),
    ];
});
