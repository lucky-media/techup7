<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Post;

class DisplayPost extends Component
{
    public $post;

    // The listener is used to refresh the component if an answer is deleted or flaged
    protected $listeners = ['refresh' => '$refresh'];

    public function mount($post)
    {
        $this->post = Post::whereId($post->id)
                            ->with('user.profile')
                            ->withCount('children')
                            ->first();
    }

    public function render()
    {
        return view('livewire.display-post');
    }
}

