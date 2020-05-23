<?php

namespace App\Policies;

use App\User;
use App\Lesson;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create courses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Lesson $lesson)
    {
        if ($user->role == 'admin'){
            return true;
        }
        elseif ($user->id == $lesson->course->user_id)
        {
            return true;
        }
        else
        return false;
    }

    /**
     * Determine whether the user can update the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function update(User $user, Lesson $lesson)
    {        
        if ($user->role == 'admin'){
            return true;
        }
        elseif ($user->id == $lesson->course->user_id)
        {
            return true;
        }
        else
        return false;
    }

    /**
     * Determine whether the user can delete the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function delete(User $user, Lesson $lesson)
    {
        if ($user->role == 'admin'){
            return true;
        }
        elseif ($user->id == $lesson->course->user_id)
        {
            return true;
        }
        else
        return false;
    }
}