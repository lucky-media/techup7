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
        factory(App\User::class, 20)->create(['role' => 'instructor'])->each(function ($user) {
            $user->courses()->saveMany(factory(App\Course::class, 20)
                ->make())
                ->each(function ($course) {
                    $course->lesson()->saveMany(factory(App\Lesson::class, 10)->make());
                });
        });
    }
}
