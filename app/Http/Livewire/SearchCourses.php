<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Course;
use Livewire\WithPagination;

class SearchCourses extends Component
{
    use WithPagination;

    public $searchTerm;
    protected $courses;
    protected $pagination = '9';

    public function render()
    { 
        $this->courses = Course::query()
                                ->where('title', 'like', '%'.$this->searchTerm.'%') 
                                ->orWhere('body', 'like', '%'.$this->searchTerm.'%')
                                ->orderBy('created_at', 'desc')
                                ->paginate($this->pagination);

        return view('livewire.search-courses', [
            'courses' => $this->courses,
        ]);
    }
}
