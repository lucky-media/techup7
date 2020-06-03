<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'role', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class)->orderBy('created_at', 'DESC');
    }
    
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_user');
    }

    public function hasRole($role)
    {
        if ($role == $this->role)
        {
            return true;
        }
        else
            return false;
    }
}
