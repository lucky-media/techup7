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
    public $completedLessons = [];

    public function mount($lessons, $course)
    {
        $this->lessons = $lessons;
        $this->course = $course;

        // Get the id of all the lessons that are marked as complete by current user
        foreach (auth()->user()->lessons as $lesson) {
            $this->completedLessons[] = $lesson->id;
       }
    }

    // This function arranges the lessons of a course by moving the lesson down
    public function arrangeDown($id, $position)
    {        
        $nextLesson = Lesson::where('course_id', '=', $id)->where('position', '=', $position+1)->first();
        $currentLesson = Lesson::where('course_id', '=', $id)->where('position', '=', $position)->first();
        
        $nextLesson->position = $position;
        $currentLesson->position = $position+1;

        $nextLesson->save();
        $currentLesson->save();

        $this->lessons = Lesson::where('course_id', $id);
    }

    // This function arranges the lessons of a course by moving the lesson up
    public function arrangeUp($id, $position)
    {        
        $previousLesson = Lesson::where('course_id', '=', $id)->where('position', '=', $position-1)->first();
        $currentLesson = Lesson::where('course_id', '=', $id)->where('position', '=', $position)->first();
        
        $previousLesson->position = $position;
        $currentLesson->position = $position-1;

        $previousLesson->save();
        $currentLesson->save();

        $this->lessons = Lesson::where('course_id', $id);
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
