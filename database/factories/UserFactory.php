<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
| 
| The User is created with a fake name, username and a unique email
| The role is randomly set as student or instructor, and the password is set as "secret"
| 
*/
$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'role' => $faker->randomElement(['student', 'instructor']),
        'email_verified_at' => now(),
        'password' => Hash::make('secret'), // secret
        'remember_token' => Str::random(10),
    ];
});
