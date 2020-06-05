<?php

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 
     * Create 5 instructors, each one has 5 courses, each course has 5 lessons, each lesson has 3 comments
     * The position of those lessons starts with 1 and ends with 5 for the last lesson.
     * The course also has 3 comments where the user is with id between 2 to 8, because 1 belongs to admin
     * 
     */
    public function run()
    {
        factory(App\User::class, 5)->create(['role' => 'instructor'])
            ->each(function ($user) {
            $user->courses()->saveMany(factory(App\Course::class, 5)
                 ->make())
                 ->each(function ($course) {
                    $course->comments()->saveMany(factory(App\Comment::class, 3)->make());
                    $course->lesson()->saveMany(factory(App\Lesson::class, 5)->make())
                        ->each(function ($lesson, $position = 1) use ($course) {
                            $lesson->position = ++$position;
                            $lesson->save();
                            $lesson->comments()->saveMany(factory(App\Comment::class, 3)->make());
                        });
                });
        });
    }
}
