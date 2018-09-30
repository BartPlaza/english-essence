<?php

use App\Dictionary;
use Faker\Generator as Faker;

$factory->define(Dictionary::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'user_id' => $faker->randomNumber()
    ];
});
