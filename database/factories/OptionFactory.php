<?php

use Faker\Generator as Faker;

$factory->define(App\Option::class, function (Faker $faker) {
    return [
        'options_text' => $faker->word,
    ];
});
