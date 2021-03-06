<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create comments.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function create(User $user, Comment $comment)
    {
        return true;
    }

    /**
     * Determine whether the user can update the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        if ($user->role == 'admin'){
            return true;
        }
        elseif ($user->id == $comment->user_id)
        {
            return true;
        }
        else
        return false;
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        if ($user->role == 'admin'){
            return true;
        }
        elseif ($user->id == $comment->user_id)
        {
            return true;
        }
        else
        return false;
    }

    /**
     * Only instructors can flag a comment on their lesson as inappropriate
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function flagInappropriate(User $user, Comment $comment)
    {
        if ($user->id != $comment->user_id && $comment->approved == '1')
        {
            return true;
        }
    }
    
    /**
     * Flagged comments cannot be flagged again
     *
     * @param  \App\Comment  $comment
     * @return mixed
     */
    
    public function flagged(User $user, Comment $comment)
    {
        if ($comment->approved == '0')
        {
            return true;
        }
    }

    /**
     * Approve flagged comments
     *
     * @param  \App\Comment  $comment
     * @return mixed
     */
    
    public function approve(User $user, Comment $comment)
    {
        if ($comment->approved == '0' && auth()->user()->role == 'admin')
        {
            return true;
        }
    }
}