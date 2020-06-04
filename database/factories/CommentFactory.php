<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

// Create a fake comment where approved is true and the body has a fake text
$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(2,8),
        'approved' => true,
        'body' => $faker->text,
    ];
});
