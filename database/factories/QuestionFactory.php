<?php

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [     
        'question_text' => $faker->sentence,
        'question_type' => 'multi',
    ];
});
