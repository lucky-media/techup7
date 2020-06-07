<?php

namespace App\Http\Livewire;

use App\Notifications\NewComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Livewire\Component;

class AddComment extends Component
{
    public $body;
    public $commentable;
    public $comments;
    public $commentsCount;

    // The listener is used to refresh the component if a comment is deleted or flaged
    protected $listeners = ['refresh' => 'refreshComments'];

    public function mount($commentable)
     {
        $this->commentable = $commentable;
        $this->comments = $this->commentable->comments;
        $this->commentsCount = $this->commentable->commentsCount();
     }

    public function refreshComments()
    {
        // We refresh the component data by calling a refreshed commentable and comments
        $this->commentable = $this->commentable->refresh();
        $this->comments = $this->commentable->comments;
        $this->commentsCount = $this->commentable->commentsCount();
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

        $this->sendNotification($data['body']);
        
        $this->refreshComments();
    }

    // Send notification to content owner
    public function sendNotification($data)
    {        
        // Info about the user adding the comment
        $info['name'] = auth()->user()->name;
        $info['email'] = auth()->user()->email;
        $info['comment'] = $data;

        
        /* 
         * Check if we are currently at a course, or a lesson page
         * Notify the course owner if he has enabled emails on the settings
        */ 
        
        if ($this->commentable->user){
            if ($this->commentable->user->settings->new_comment){
                $info['url'] = asset('/').'courses/'.$this->commentable->slug;
                $this->commentable->user->notify(new NewComment($info));
            }
        }
        // If we are at a lesson then notify lesson owner if he has enabled emails
        else{
            if ($this->commentable->course->user->settings->new_comment){
                $info['url'] = asset('/').'lessons/'.$this->commentable->slug;
                $this->commentable->course->user->notify(new NewComment($info));
            }
        }
    }

    public function render()
    {   
        return view('livewire.add-comment');
    }
}
