<?php

use Faker\Generator as Faker;

$factory->define(App\BudgetSubcategory::class, function (Faker $faker) {
    return [
        'budget_category_id' => factory(\App\BudgetCategory::class)->create()->id,
        'name' => 'some-name',
        'budget' => $faker->randomFloat(2, 1, 2000),
    ];
});
