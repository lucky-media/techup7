<?php

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 5)->create(['role' => 'instructor'])->each(function ($user) {
            $user->courses()->saveMany(factory(App\Course::class, 5)
                ->make())
                ->each(function ($course) {
                    $course->lesson()->saveMany(factory(App\Lesson::class, 5)->make())
                        ->each(function ($lesson) use ($course) {
                            $lesson->comments()->saveMany(factory(App\Comment::class, 3)->make(['user_id' => $course->user_id]));
                        });
                });
        });
    }
}