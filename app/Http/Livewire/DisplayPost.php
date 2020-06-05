<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Post;

class DisplayPost extends Component
{
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
        // The input field is set to empty
        $this->reset('body');

        $this->post = $this->post->refresh();
    }

    public function render()
    {
        return view('livewire.display-post');
    }
}

