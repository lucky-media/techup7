<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Course;
use Livewire\WithPagination;

class SearchCoursesByInstructor extends Component
{
    use WithPagination;

    public $searchTerm;
    protected $courses;
    public $lang;
    public $user;
    protected $pagination = '9';

    // we get the instructor owner of the current profile
    public function mount($user)
    {
        $this->user = $user;
    }

    public function switchLanguage($val = NULL){
        $this->lang = $val;
    }

    /*  
     *  Showing all courses created by instructor profile owner
     *  Filter by language, or the query matching the title or body
     *  Eager loading the user table and through the user we eager load the profile table
     */
    
    public function render()
    { 
        $this->courses = Course::query()
                                ->where('user_id', "{$this->user->id}")
                                ->where('lang', 'LIKE', "%". ($this->lang) ? $this->lang : '' . "%")
                                ->where(function($query) {
                                    $query->where('title', 'LIKE', "%{$this->searchTerm}%") 
                                          ->orWhere('body', 'LIKE', "%{$this->searchTerm}%");
                                })
                                ->with('user.profile')
                                ->orderBy('created_at', 'desc') 
                                ->paginate($this->pagination);

        return view('livewire.search-courses', [
            'courses' => $this->courses,
        ]);
    }
}
