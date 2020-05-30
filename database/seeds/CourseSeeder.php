<?php

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 
     * We create 5 instructors, each one has 5 courses, each course has 5 lessons, each lesson has 3 comments
     * 
     */
    public function run()
    {
        factory(App\User::class, 5)->create(['role' => 'instructor'])->each(function ($user) {
            $user->courses()->saveMany(factory(App\Course::class, 5)
                ->make())
                ->each(function ($course) {
                    $course->lesson()->saveMany(factory(App\Lesson::class, 5)->make())
                        ->each(function ($lesson, $position = 1) use ($course) {
                            $lesson->position = ++$position;
                            $lesson->save();
                            $lesson->comments()->saveMany(factory(App\Comment::class, 3)->make(['user_id' => $course->user_id]));
                        });
                });
        });  
    }
}
