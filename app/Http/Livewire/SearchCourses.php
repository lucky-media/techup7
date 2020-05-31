<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Course;
use Livewire\WithPagination;

class SearchCourses extends Component
{
    use WithPagination;

    public $searchTerm;
    public $courses;

    public function render()
    { 
        // This part needs to be fixed to support pagination with Livewire
        // ->paginate(10);

        $this->courses = Course::query()
        ->where('title', 'like', '%'.$this->searchTerm.'%') 
        ->orWhere('body', 'like', '%'.$this->searchTerm.'%')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('livewire.search-courses');
    }
}
