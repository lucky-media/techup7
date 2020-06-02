<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Lesson;

class CommentLesson extends Component
{
    public $body;
    public $lesson;
    public $comments;

    public function mount(Lesson $lesson)
     {
         $this->lesson = $lesson;
         $this->comments = $this->lesson->comments;
     }

    public function addComment()
    {
        $data = $this->validate([
            'body' => 'required|min:2',
        ]);

        $this->lesson->comments()->create([
            'user_id' => auth()->user()->id,
            'body' => $data['body'],
        ]);

        $this->reset('body');
        
        $this->lesson = $this->lesson->refresh();
        $this->comments = $this->lesson->comments;
    }

    public function render()
    {   
        return view('livewire.comment-lesson');
    }
}
