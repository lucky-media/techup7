<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;

use Livewire\Component;
use App\Lesson;

class CompletedLessons extends Component
{
    public $lesson;
    public $completed;

    private function getCompleted(){
        $data = DB::table('lesson_user')
                                ->where('user_id', auth()->user()->id)
                                ->where('lesson_id', $this->lesson->id)
                                ->count();
        return $data;
    }

    public function mount(Lesson $lesson){
        $this->lesson = $lesson;
        
        if (auth()->user()){
            $this->completed = $this->getCompleted();
        }
    }

    public function markCompleted()
    {
        $this->lesson->users()->toggle(auth()->user()->id);
        
        $this->completed = $this->getCompleted();

        // Refreshing the component courseLessons after we mark this lesson as completed
        $this->emit('refreshList');
    }

    public function render()
    {
        return view('livewire.completed-lessons');
    }
}
