<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DisplayAnswer extends Component
{
    public $answer;
    public $liked = 0;
    public $totalLikes;

    // The listener is used to refresh the component if a answer is deleted or flagged
    protected $listeners = ['refresh' => '$refresh'];

    public function mount($answer)
    {
        $this->answer = $answer;

        if (auth()->user()){
            $this->liked = $this->getLike();
        }

        $this->totalLikes = $this->getTotalLikes();
    }

    public function deleteAnswer()
    {
        if ($this->answer->id == $this->answer->commentable->best_answer)
        {
            $this->answer->commentable->update([
                'best_answer' => null,
                ]);
        }
        
        $this->answer->delete();

        // Refreshing the component parent, because this answer is deleted
        $this->emitUp('refresh');
    }

    // Flags a answer as inappropriate and the admin choose if he deletes it
    public function flagInappropriate()
    {
        $this->answer->update([
        'approved' => false,
        ]);

        // Refreshing the component parent
        $this->emitUp('refresh');
    }
    
    // Choose best answer
    public function bestAnswer()
    {
        $this->answer->commentable->update([
        'best_answer' => $this->answer->id,
        ]);

        // Refreshing the component parent
        $this->emitUp('refresh');
    }

    // Check if user has liked this answer
    private function getLike(){
        $data = DB::table('comment_user')
                                ->where('user_id', auth()->user()->id)
                                ->where('comment_id', $this->answer->id)
                                ->count();
        return $data;
    }

    // Like the answer
    public function likeAnswer()
    {
        $this->answer->likes()->toggle(auth()->user()->id);
        
        $this->liked = $this->getLike();

        // Refreshing the component parent
        $this->emitUp('refresh');
    }

    // Get total likes for this comment
    private function getTotalLikes(){
        $data = DB::table('comment_user')
                                ->where('comment_id', $this->answer->id)
                                ->count();
        return $data;
    }

    public function render()
    {
        return view('livewire.display-answer');
    }
}
