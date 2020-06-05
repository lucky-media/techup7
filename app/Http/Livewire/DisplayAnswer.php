<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DisplayAnswer extends Component
{
    public $answer;

    // The listener is used to refresh the component if a answer is deleted or flagged
    protected $listeners = ['refresh' => '$refresh'];

    public function mount($answer)
    {
        $this->answer = $answer;
    }

    public function deleteAnswer()
    {
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
    }

    public function render()
    {
        return view('livewire.display-answer');
    }
}
