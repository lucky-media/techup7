<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

// Create a fake comment where approved is true and the body has a fake text
$factory->define(Comment::class, function (Faker $faker) {
    return [
        'approved' => true,
        'body' => $faker->text,
    ];
});
