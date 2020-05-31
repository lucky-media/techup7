<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Course;
use Livewire\WithPagination;

class SearchCoursesByInstructor extends Component
{
    use WithPagination;

    public $searchTerm;
    public $courses;
    public $user;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    { 
        // This part needs to be fixed to support pagination with Livewire

        // $this->courses = Course::query()
        // ->where('user_id', "{$this->user->id}")
        // ->where(function($query) {
        //     $query->where('title', 'LIKE', "%{$this->searchTerm}%") 
        //           ->orWhere('body', 'LIKE', "%{$this->searchTerm}%");
        // })
        // ->orderBy('created_at', 'desc')
        // ->paginate(3);

        $this->courses = Course::query()
        ->where('user_id', "{$this->user->id}")
        ->where(function($query) {
            $query->where('title', 'LIKE', "%{$this->searchTerm}%") 
                  ->orWhere('body', 'LIKE', "%{$this->searchTerm}%");
        })
        ->orderBy('created_at', 'desc') 
        ->get();

        return view('livewire.search-courses');
    }
}
