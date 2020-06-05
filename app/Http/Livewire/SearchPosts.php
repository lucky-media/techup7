<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Post;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class SearchPosts extends Component
{
    use WithPagination;

    public $searchTerm;
    public $lang;
    protected $posts;
    protected $pagination = '9';

    // If the language is not sq or al, we set it to null so that we can display posts from both languages
    public function switchLanguage($val = NULL){
        $this->lang = $val;
    }

    /*
     * Showing all posts and provides searching with the term entered by user
     * If language is not available, all posts are displayed. Or we display the required language only 
     */ 

    public function render()
    {
        $this->posts = Post::query()
                            ->where('lang', 'LIKE', "%". ($this->lang) ? $this->lang : '' . "%")
                            ->where(function($query) {
                                $query->where('title', 'LIKE', "%{$this->searchTerm}%") 
                                      ->orWhere('body', 'LIKE', "%{$this->searchTerm}%");
                            })
                            ->orderBy('created_at', 'desc')
                            ->paginate($this->pagination);

        return view('livewire.search-posts', [
        'posts' => $this->posts,
        ]);
    }
}
