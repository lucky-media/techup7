<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function answers()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'commentable_id', 'id')->where('commentable_type', 'App\Post');
    }

    public function answersCount()	
    {	
        return Comment::where('commentable_id', '=', $this->id)
                            ->where('commentable_type', '=', 'App\Post')
                            ->count();
    }
}
