<?php

namespace App\Policies;

use App\Profile;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create profiles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Profile $profile)
    {
        if ($user->role == 'admin'){
            return true;
        }
        elseif ($user->id == $profile->user_id && $user->role == 'instructor')
        {
            return true;
        }
        else
        return false;   
    }

    /**
     * Determine whether the user can update the profile.
     *
     * @param  \App\User  $user
     * @param  \App\Profile  $profile
     * @return mixed
     */
    public function update(User $user, Profile $profile)
    {
        if ($user->role == 'admin'){
            return true;
        }
        elseif ($user->id == $profile->user_id)
        {
            return true;
        }
        else
        return false;
    }
}