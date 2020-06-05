<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'slug' => $faker->slug,
        'body' => $faker->paragraph($nbSentences = 5, $variableNbSentences = true),
        'lang' => $faker->randomElement(['sq', 'mk']),
        'created_at' => $faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null),
    ];
});
