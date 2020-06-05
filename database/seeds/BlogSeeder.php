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
        $users = App\User::whereIn('id', [2, 3, 4])->get();
        $usersCompleted = App\User::whereIn('id', [5, 6])->get();

        foreach ($users as $user)
        {
            factory(App\Post::class, 1)->create(['user_id' => $user->id]);
        }

        foreach ($usersCompleted as $user)
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
