<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

/**
*   Create a fake Course with a fake sentence for the title, a slug, body text, no_image as cover image
*   The language is randomly chosen as sq or mk.
*   The category_id is a random number from 1-5. 
*   The created_at is set on a random date from the last 10 years.
*/

$factory->define(Course::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'slug' => $faker->slug,
        'body' => $faker->paragraph($nbSentences = 5, $variableNbSentences = true),
        'image' => asset('storage/no_image.jpg'),
        'lang' => $faker->randomElement(['sq', 'mk']),
        'category_id' => $faker->numberBetween(1,5),
        'created_at' => $faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null),
    ];
});
