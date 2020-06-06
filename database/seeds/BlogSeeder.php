<?php

use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $someUsers = App\User::whereIn('id', [2, 3, 4])->get();
        $otherUsers = App\User::whereIn('id', [5, 6])->get();

        // Create some posts with no answer yet
        foreach ($someUsers as $user)
        {
            factory(App\Post::class, 1)->create([
                'user_id' => $user->id
                ])
                ->each(function ($post) {
                        $post->answers()->saveMany(factory(App\Comment::class, 2)
                        ->make());
                        });
        }

        // Create posts with a best answer already chosen
        foreach ($otherUsers as $user)
        {
            $post = factory(App\Post::class, 1)->create([
                'user_id' => $user->id
                ])
                ->each(function ($post) {
                        $answer = $post->answers()->save(factory(App\Comment::class)
                        ->make());
                        $post->best_answer = $answer->id;
                        $post->save();
                        });
        }
    }
}
