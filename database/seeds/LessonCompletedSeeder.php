<?php

use Illuminate\Database\Seeder;
use App\Lesson;
use App\User;

class LessonCompletedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * We add some completed lessons for the user student
     * The lessons are randomly selected
     * 
     * @return void
     */
    public function run()
    {
        $user = User::whereRole('student')->first();

        $lessons = Lesson::all()->random(20);

        foreach ($lessons as $lesson)
        {
            $lesson->users()->attach($user->id);
        }
    }
}
