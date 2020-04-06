<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Comment;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $this->middleware('role');
        
        $comments = Comment::where('approved', '!=', 'true')->latest()->paginate(10);
        
        return view('comments.index', compact('comments'));
    }
    
    public function store()
    {
        $data = request()->validate([
            'lesson_id' => 'required',
            'body' => 'required|min:2',
        ]);

        $comment = new Comment;

        $comment->body = $data['body'];

        $comment->user_id = auth()->user()->id;

        $lesson = Lesson::find($data['lesson_id']);

        $lesson->comments()->save($comment);

        return back();
    }
    
    public function reply()
    {
        $data = request()->validate([
            'body' => 'required|min:2',
            'lesson_id' => 'required',
            'comment_id' => 'required',
        ]);

        $reply = new Comment();

        $reply->body = $data['body'];

        $reply->user_id = auth()->user()->id;

        $reply->parent_id = $data['comment_id'];

        $lesson = Lesson::find($data['lesson_id']);

        $lesson->comments()->save($reply);

        return back();
    }

    public function approved(Comment $comment)
    {
        $this->middleware('role');
        
        $data = request()->validate([
            'approved' => 'required',
        ]);

        $comment->update([
            'approved' => $data['approved'],
        ]);
        
        return redirect('/comments');
    }

    public function destroy(Comment $comment)
    {
        $this->middleware('role');

        $comment->delete();
        
        return back();
    }

    public function edit(Comment $comment)
    {

        $this->authorize('update', $comment);

        return view('comments.edit', compact('comment'));
    }

    public function update(Comment $comment)
    {
        $data = request()->validate([
            'lesson_id' => 'required',
            'body' => 'required|min:2',
        ]);

        $comment->update([
            'lesson_id' => $data['lesson_id'],
            'user_id' => auth()->user()->id,
            'body' => $data['body'],
        ]);
        
        return redirect('/lessons/'. $comment->lesson->id);
    }

    public function flag(Comment $comment)
    {         
        $data = request()->validate([
            'approved' => 'required',
        ]);
        
        $comment->update([
            'approved' => $data['approved'],
        ]);
        dd($comment);
        return redirect('/lessons/'. $comment->lesson["slug"]);
    }
}