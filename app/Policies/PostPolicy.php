<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Post $post)
    {
        if ($user->role == 'admin'){
            return true;
        }
        elseif ($user->id == $post->user_id)
        {
            return true;
        }
        else
        return false;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {        
        if ($user->role == 'admin'){
            return true;
        }
        elseif ($user->id == $post->user_id)
        {
            return true;
        }
        else
        return false;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        if ($user->role == 'admin'){
            return true;
        }
        elseif ($user->id == $post->user_id)
        {
            return true;
        }
        else
        return false;
    }
}