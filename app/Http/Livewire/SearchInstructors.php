<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
use Livewire\WithPagination;

class SearchInstructors extends Component
{
    use WithPagination;

    public $searchTerm;
    public $users;

    public function render()
    {
        // This part needs to be fixed to support pagination with Livewire

        // $this->users = User::query()
        //                 ->where('name', 'LIKE', "%{$this->searchTerm}%") 
        //                 ->where('role', '=', "instructor")
        //                 ->orderBy('created_at', 'desc')
        //                 ->paginate(9);

        $this->users = User::query()
                        ->where('name', 'LIKE', "%{$this->searchTerm}%") 
                        ->where('role', '=', "instructor")
                        ->orderBy('created_at', 'desc')
                        ->get(); 

        return view('livewire.search-instructors');
    }
}
