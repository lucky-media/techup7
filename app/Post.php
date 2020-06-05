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

    public function bestAnswer()
    {
        return $this->belongsTo(Comment::class);
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
        return $this->hasMany(Comment::class, 'commentable_id', 'id');
    }

    public function answersCount()	
    {	
        $answers = Comment::where('commentable_id', '=', $this->id)
                            ->where('commentable_type', '=', 'App\Post')
                            ->get();	

        return $answers->count();
    }
}
