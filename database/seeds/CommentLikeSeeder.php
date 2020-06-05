<?php

use Illuminate\Database\Seeder;
use App\Comment;
use App\User;

class CommentLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::whereRole('student')->first();

        $comments = Comment::all()->random(200);

        foreach ($comments as $comment)
        {
            $comment->likes()->attach($user->id);
        }
    }
}
