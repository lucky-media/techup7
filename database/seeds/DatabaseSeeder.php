<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * 
     * Create three users (admin, instructor, student)
     * Make some random categories
     * Create 5 instructors, each one has 5 courses, each course has 5 lessons, each lesson has 3 comments
     * Add some completed lessons for the student
     * 
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(LessonCompletedSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(CommentLikeSeeder::class);
    }
}
