<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Course;
use App\Lesson;

class CourseLessons extends Component
{
    public $lesson;
    public $course;
    public $completedLessons = [];

    // The listener is used to refresh the component if a lesson is marked as complete
    protected $listeners = ['refreshList' => 'refreshList'];

    public function refreshList(){
        $this->course = Course::find($this->course->id);
        $this->completedLessons = [];
        
        // Get the id of all the lessons that are marked as complete by current user
        foreach (auth()->user()->lessons as $lesson) {
            $this->completedLessons[] = $lesson->id;
       }
    }
    
    // we get the student owner of the current profile
    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;

        $this->course = Course::find($lesson->course->id);
        
        // Get the id of all the lessons that are marked as complete by current user
        foreach (auth()->user()->lessons as $lesson) {
            $this->completedLessons[] = $lesson->id;
       }
    }

    public function render()
    {                 
        return view('livewire.course-lessons');
    }
}
