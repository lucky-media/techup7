<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];
    protected $fillable = ['title', 'slug', 'body', 'image', 'lang', 'category'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function lesson()
    {
        return $this->hasMany(Lesson::class)->orderBy('created_at', 'DESC');
    }

    public function children(){
        return $this->hasMany(Lesson::class, 'course_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
