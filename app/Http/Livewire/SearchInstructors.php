<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
use Livewire\WithPagination;

class SearchInstructors extends Component
{
    use WithPagination;

    public $searchTerm;
    protected $users;
    protected $pagination = '9';

    public function render()
    {
        $this->users = User::query()
                        ->where('name', 'LIKE', "%{$this->searchTerm}%") 
                        ->where('role', '=', "instructor")
                        ->orderBy('created_at', 'desc')
                        ->paginate($this->pagination); 

        return view('livewire.search-instructors', [
            'users' => $this->users,
        ]);
    }
}
