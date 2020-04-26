<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'slug' => $faker->slug,
        'body' => $faker->text,
        'image' => asset('storage/no_image.jpg'),
        'lang' => $faker->randomElement(['mk', 'sq']),
    ];
});

//
//$factory->afterCreating(Course::class, function ($course) {
//    $course->lesson()->saveMany(factory(App\Lesson::class, 10)->make());
//});
