<?php

namespace App\Http\Controllers;

use App\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Admin views all comments that are flagged as inappropriate
    public function index()
    {
        $this->middleware('role');
        
        $comments = Comment::with('user.profile')->where('approved', '=', false)->get();
        
        return view('comments.index', compact('comments'));
    }
        
    public function edit(Comment $comment)
    {        
        $this->authorize('update', $comment);    
        
        return view('comments.edit', compact('comment'));
    }
    
    public function update(Comment $comment)
    {
        $data = request()->validate([
            'body' => 'required|min:2',
            ]);
            
        $comment->update([
            'body' => $data['body'],
            ]);

        $commentable = $comment->commentable;

        if (class_basename(get_class($commentable)) == 'Lesson'){    
            return redirect('/lessons/'. $comment->lesson->slug);
        }
        else
        {
            return redirect('/courses/'. $comment->course->slug);
        }
        
    }
}
