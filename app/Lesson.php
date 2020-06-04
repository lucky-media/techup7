<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'lesson_user');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'commentable_id', 'id');
    }

    public function commentsCount()
    {
        $comments = Comment::where('commentable_id', '=', $this->id)->get();

        return $comments->count();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
