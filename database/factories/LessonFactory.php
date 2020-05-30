<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Lesson;
use Faker\Generator as Faker;

// The Lesson is created with a fake sentence for the title, slug and body
$factory->define(Lesson::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'slug' => $faker->slug,
        'body' => $faker->text,
        'position' => 0,
    ];
});
