<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

      
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('created_at', 'DESC');
    }
}
