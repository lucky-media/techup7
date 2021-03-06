<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Course;
use Livewire\WithPagination;

class SearchCourses extends Component
{
    use WithPagination;

    public $searchTerm;
    public $lang;
    protected $courses;
    protected $pagination = '9';

    // If the language is not sq or al, we set it to null so that we can display courses from both languages
    public function switchLanguage($val = NULL){
        $this->lang = $val;
    }

    /*  
     *  Showing all courses and provides searching with the term entered by user
     *  If language is not available, all courses are displayed. Or we display the required language only
     *  Eager loading the user table and through the user we eager load the profile table
     */

    public function render()
    {             
        $this->courses = Course::query()
                                ->where('lang', 'LIKE', "%". ($this->lang) ? $this->lang : '' . "%")
                                ->where(function($query) {
                                    $query->where('title', 'LIKE', "%{$this->searchTerm}%") 
                                        ->orWhere('body', 'LIKE', "%{$this->searchTerm}%");
                                })
                                ->with('user')
                                ->orderBy('created_at', 'desc')
                                ->paginate($this->pagination);

        return view('livewire.search-courses', [
            'courses' => $this->courses,
        ]);
    }
}
