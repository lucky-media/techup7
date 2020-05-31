<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use App\Lesson;

class SearchLessons extends Component
{
    public $searchTerm;
    public $lessons;
    public $course;

    public function mount($lessons, $course)
    {
        $this->lessons = $lessons;
        $this->course = $course;
    }

    public function render()
    {
        $this->lessons = Lesson::query()
                                ->where('course_id', "{$this->course->id}")
                                ->where(function($query) {
                                    $query->where('title', 'LIKE', "%{$this->searchTerm}%") 
                                          ->orWhere('body', 'LIKE', "%{$this->searchTerm}%");
                                })
                                ->get();

        return view('livewire.search-lessons');
    }
}
