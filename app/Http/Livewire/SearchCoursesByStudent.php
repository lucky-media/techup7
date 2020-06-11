<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Course;
use App\User;
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

    // we get the student owner of the current profile with eager loading lessons and course table
    public function mount($user)
    {
        $this->user = User::whereId($user->id)->with('lessons.course')->first();
        
        // The user model function makes sure we have unique courses
        foreach ($this->user->lessons as $lesson) {
            $this->courseIds[] = $lesson->course->id;
       }
    }

    /*  
     *  Search courses where the student profile owner has completed at least one lesson
     *  Eager loading the user table and through the user we eager load the profile table
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
                                ->with('user')
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
