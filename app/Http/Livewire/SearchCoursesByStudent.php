<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Course;
use App\Lesson;
use Livewire\WithPagination;

class SearchCoursesByStudent extends Component
{
    use WithPagination;

    public $searchTerm;
    protected $courses;
    public $courseIds = [];
    public $lang;
    public $user;
    protected $pagination = '9';

    // we get the student owner of the current profile
    public function mount($user)
    {
        $this->user = $user;
        
        // The user model function makes sure we have unique courses
        foreach ($this->user->lessons as $lesson) {
            $this->courseIds[] = $lesson->course->id;
       }
    }

    /*  Search courses where the student profile owner has completed at least one lesson
     *  Filter by language, or the query matching the title or body
     */
    public function getCoursesById(){
        $this->courses = Course::query()
                                ->whereIn('id', $this->courseIds)
                                ->where('lang', 'LIKE', "%". ($this->lang) ? $this->lang : '' . "%")
                                ->where(function($query) {
                                    $query->where('title', 'LIKE', "%{$this->searchTerm}%") 
                                        ->orWhere('body', 'LIKE', "%{$this->searchTerm}%");
                                })
                                ->orderBy('created_at', 'desc')
                                ->paginate($this->pagination);
    }

    public function switchLanguage($val = NULL){
        $this->lang = $val;
        $this->getCoursesById();
    }

    public function render()
    {
        $this->getCoursesById();                     

        return view('livewire.search-courses', [
            'courses' => $this->courses,
        ]);
    }
}
