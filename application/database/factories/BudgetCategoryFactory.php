<?php

use Faker\Generator as Faker;

$factory->define(App\BudgetCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement([
            'car',
            'utilities',
            'home',
        ]),
        'type' => $faker->randomElement(['income', 'expense']),
    ];
});
