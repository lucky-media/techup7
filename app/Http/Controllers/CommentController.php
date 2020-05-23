<?php

namespace App\Http\Controllers;

use App\Lesson;
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
        
        $comments = Comment::where('approved', '=', 'false')->paginate(10);
        
        return view('comments.index', compact('comments'));
    }

    public function store()
    {
        $data = request()->validate([
            'lesson_id' => 'required',
            'body' => 'required|min:2',
        ]);

        $lesson = Lesson::find($data['lesson_id']);
        
        $lesson->comments()->create([
            'user_id' => auth()->user()->id,
            'body' => $data['body'],
        ]);

        return back();
    }
    
    // Adding a comment reply requires the parent comment id
    public function reply()
    {
        $data = request()->validate([
            'body' => 'required|min:2',
            'lesson_id' => 'required',
            'comment_id' => 'required',
        ]);
        
        $lesson = Lesson::find($data['lesson_id']);
        
        $lesson->comments()->create([
            'user_id' => auth()->user()->id,
            'parent_id' => $data['comment_id'],
            'body' => $data['body'],
        ]);

        return back();
    }

    // When deleting a comment we also delete the comment replies
    public function destroy($id){
        // Getting the parent category
        $parent = Comment::findOrFail($id);
        
        // Getting all children ids
        $array_of_ids = $this->getChildren($parent);
        
        // Appending the parent category id
        array_push($array_of_ids, $id);
        
        // Destroying all of them
        Comment::destroy($array_of_ids);
        
        return back();
    }
    
    private function getChildren($category){
        $ids = [];

        foreach ($category->children as $cat) {
            $ids[] = $cat->id;
            $ids = array_merge($ids, $this->getChildren($cat));
        }
        return $ids;
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
                
        return redirect('/lessons/'. $comment->lesson->slug);
    }

    public function flag(Comment $comment)
    {         
        $data = request()->validate([
            'approved' => 'required',
        ]);
        
        $comment->update([
        'approved' => $data['approved'],
        ]);

        return redirect('/lessons/'. $comment->lesson->slug);
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
}
