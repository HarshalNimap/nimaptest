<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\category;
use Faker\Generator as Faker;

$factory->define(category::class, function (Faker $faker) {
    return [
        'category_name' => $faker->word,
        'created_by' => '1',
        'updated_by' => '1',
        'active' => '1'
    ];
});
