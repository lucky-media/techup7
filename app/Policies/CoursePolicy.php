<?php

namespace App\Policies;

use App\Course;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create courses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Course $course)
    {
        if ($user->role == 'admin'){
            return true;
        }
        elseif ($user->id == $course->user_id)
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
    public function update(User $user, Course $course)
    {        
        if ($user->role == 'admin'){
            return true;
        }
        elseif ($user->id == $course->user_id)
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
    public function delete(User $user, Course $course)
    {
        if ($user->role == 'admin'){
            return true;
        }
        elseif ($user->id == $course->user_id)
        {
            return true;
        }
        else
        return false;
    }
}