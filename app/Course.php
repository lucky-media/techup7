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

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function commentsCount()	
    {	
        return Comment::where('commentable_id', '=', $this->id)
                            ->where('commentable_type', '=', 'App\Course')
                            ->count();	
    }
}