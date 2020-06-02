<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Lesson;

class CommentLesson extends Component
{
    public $body;
    public $lesson;
    public $comments;

    // The listener is used to refresh the component if a comment is deleted or flaged
    protected $listeners = ['refresh' => '$refresh'];

    public function mount(Lesson $lesson)
     {
         $this->lesson = $lesson;
         $this->comments = $this->lesson->comments;
     }

    // We add only the body and the lesson->id when creating a comment
    public function addComment()
    {
        $data = $this->validate([
            'body' => 'required|min:2',
        ]);

        $this->lesson->comments()->create([
            'user_id' => auth()->user()->id,
            'body' => $data['body'],
        ]);

        // The input field is set to empty
        $this->reset('body');
        
        // We refresh the component data by calling a refreshed lesson and comments
        $this->lesson = $this->lesson->refresh();
        $this->comments = $this->lesson->comments;
    }

    public function render()
    {   
        return view('livewire.comment-lesson');
    }
}
