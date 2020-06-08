<?php

namespace App\Http\Livewire;

use App\Notifications\NewComment;
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

        $this->sendNotification($data['body']);
    }

    // Send notification to content owner
    public function sendNotification($data)
    {        
        // Info about the user adding the comment
        $info['name'] = auth()->user()->name;
        $info['email'] = auth()->user()->email;
        $info['comment'] = $data;
        $info['url'] = asset('/').'posts/'.$this->post->slug;
        
        // Notify the post owner if he has enabled emails on the settings
        if ($this->post->user->settings->new_answer){
            $this->post->user->notify(new NewComment($info));
        }

        /* 
         * Notify all other commenters on this post, but not the post owner
         * Also check if the users have enabled emails to be sent for new answers
        */ 
        
        foreach ($this->post->answers->unique('user_id') as $reply){
            if ($this->post->user->id != $reply->user->id){
                if ($reply->user->settings->new_answer){
                    $reply->user->notify((new NewComment($info)));
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.add-answer');
    }
}
