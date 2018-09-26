<?php

use App\Word;
use Faker\Generator as Faker;

$factory->define(Word::class, function (Faker $faker) {
    return [
        'body' => $faker->unique()->word,
        'language' => Word::LANGUAGES['pl']
    ];
});
