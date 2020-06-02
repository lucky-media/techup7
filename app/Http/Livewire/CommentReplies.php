<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Comment;
use App\Lesson;

class CommentReplies extends Component
{
    public $comment;
    public $bodyReply;
    public $lessonComment;

    public function mount(Comment $comment)
    {
        $this->comment = $comment;
    }
    

    public function replyComment()
    {
        $this->validate([
            'bodyReply' => 'required|min:2',
        ]);
        
        $this->lessonComment = Lesson::find($this->comment->commentable_id);
        
        $this->lessonComment->comments()->create([
            'user_id' => auth()->user()->id,
            'parent_id' => $this->comment->id,
            'body' => $this->bodyReply,
        ]);

        $this->reset('bodyReply');
        
        $this->comment = $this->comment->refresh();
    }

    public function render()
    {
        return view('livewire.comment-replies');
    }
}
