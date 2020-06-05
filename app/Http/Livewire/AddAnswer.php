<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Post;

class AddAnswer extends Component
{
    public $body;
    public $post;

    // The listener is used to refresh the component if an answer is deleted or flaged
    protected $listeners = ['refresh' => '$refresh'];

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    // We add only the body and post->id when creating a comment
    public function addAnswer()
    {
        $data = $this->validate([
            'body' => 'required|min:2',
        ]);

        $this->post->answers()->create([
            'user_id' => auth()->user()->id,
            'body' => $data['body'],
        ]);

        // The input field is set to empty
        $this->reset('body');

        $this->post = $this->post->refresh();
    }

    public function render()
    {
        return view('livewire.add-answer');
    }
}
