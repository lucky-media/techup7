<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    
    public function course()
    {
        return $this->hasMany(Course::class)->orderBy('created_at', 'DESC');
    }
}
