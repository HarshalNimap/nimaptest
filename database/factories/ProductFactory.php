<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\product;
use Faker\Generator as Faker;

$factory->define(product::class, function (Faker $faker) {
    return [
        'product_name' => $faker->word,
        'category_id' => rand(1,5),
        'created_by' => '1',
        'updated_by' => '1',
        'active' => '1'
    ];
});
