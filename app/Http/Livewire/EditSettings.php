<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EditSettings extends Component
{
    public $NewComment;
    public $NewReply;
    public $NewAnswer;
    public $settings;
    
    // Toggle between receiving emails for new comment on the user course or lesson
    public function newComments($val)
    {
        $this->NewComment = $this->settings->new_comment = $val;
        $this->settings->save();
    }
    
    // Toggle between receiving emails for new replies on the user comment
    public function newReplies($val)
    {
        $this->NewReply = $this->settings->new_reply = $val;
        $this->settings->save();
    }
   
    // Toggle between receiving emails for new answer on the user blog post
    public function newAnswers($val)
    {
        $this->NewAnswer = $this->settings->new_answer = $val;
        $this->settings->save();
    }

    public function getAll()
    {
        $this->settings = auth()->user()->settings;
        
        $this->NewComment = $this->settings->new_comment;
        $this->NewReply = $this->settings->new_reply;
        $this->NewAnswer = $this->settings->new_answer;
    }

    public function render()
    {        
        $this->getAll();

        return view('livewire.edit-settings');
    }
}
