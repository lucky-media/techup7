<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddComment extends Component
{
    public $body;
    public $commentable;
    public $comments;

    // The listener is used to refresh the component if a comment is deleted or flaged
    protected $listeners = ['refresh' => '$refresh'];

    public function mount($commentable)
     {
        $this->commentable = $commentable;
        $this->comments = $this->commentable->comments;
     }

    // We add only the body and commentable->id when creating a comment
    public function addComment()
    {
        $data = $this->validate([
            'body' => 'required|min:2',
        ]);

        $this->commentable->comments()->create([
            'user_id' => auth()->user()->id,
            'body' => $data['body'],
        ]);

        // The input field is set to empty
        $this->reset('body');
        
        // We refresh the component data by calling a refreshed commentable and comments
        $this->commentable = $this->commentable->refresh();
        $this->comments = $this->commentable->comments;
    }

    public function render()
    {   
        return view('livewire.add-comment');
    }
}
