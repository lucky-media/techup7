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

    // we get the current instructor
    public function mount($user)
    {
        $this->user = $user;
    }

    public function switchLanguage($val = NULL){
        $this->lang = $val;
    }

    // Showing all courses and provides searching with the term entered by user
    // If language is not available, all courses are displayed. Or we display the required language only

    public function render()
    { 
        $this->courses = Course::query()
                                ->where('user_id', "{$this->user->id}")
                                ->where('lang', 'LIKE', "%". ($this->lang) ? $this->lang : '' . "%")
                                ->where(function($query) {
                                    $query->where('title', 'LIKE', "%{$this->searchTerm}%") 
                                        ->orWhere('body', 'LIKE', "%{$this->searchTerm}%");
                                })
                                ->orderBy('created_at', 'desc') 
                                ->paginate($this->pagination);

        return view('livewire.search-courses', [
            'courses' => $this->courses,
        ]);
    }
}
