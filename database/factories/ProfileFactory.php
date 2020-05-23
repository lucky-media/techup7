<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

// The profile has a fake text for the body, and the image no_image
$factory->define(Profile::class, function (Faker $faker) {
    return [
        'bio' => $faker->text,
        'image' => asset('storage/no_image.jpg')
    ];
});
