<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];
    
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'commentable_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }
}
