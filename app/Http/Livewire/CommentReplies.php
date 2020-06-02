<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Comment;
use App\Lesson;

class CommentReplies extends Component
{
    public $comment;
    public $bodyReply;
    public $lessonComment;

    // The listener is used to refresh the component if a comment is deleted or flaged
    protected $listeners = ['refresh' => '$refresh'];
    
    public function mount(Comment $comment)
    {
        $this->comment = $comment;
    }
    
    // When deleting a comment we also delete the comment replies
    public function deleteComment()
    {
        // Getting the parent category
        $parent = Comment::findOrFail($this->comment->id);
        
        // Getting all children ids
        $array_of_ids = $this->getChildren($parent);
        
        // Appending the parent category id
        array_push($array_of_ids, $this->comment->id);
        
        // Destroying all of them
        Comment::destroy($array_of_ids);

        // Refreshing the component parent, because this comment is deleted
        $this->emitUp('refresh');
    }

    // This function gets all the children of a comment
    private function getChildren($category){
        $ids = [];

        foreach ($category->children as $cat) {
            $ids[] = $cat->id;
            $ids = array_merge($ids, $this->getChildren($cat));
        }
        return $ids;
    }
    
    // Flags a comment as inappropriate and the admin choose if he deletes it
    public function flagInappropriate()
    {
        $this->comment->update([
        'approved' => false,
        ]);
    }

    // Replying a comment is done by adding the parent id, which is the id of the comment
    public function replyComment()
    {
        $this->validate([
            'bodyReply' => 'required|min:2',
        ]);
        
        $this->lessonComment = Lesson::find($this->comment->commentable_id);
        
        $this->lessonComment->comments()->create([
            'user_id' => auth()->user()->id,
            'parent_id' => $this->comment->id,
            'body' => $this->bodyReply,
        ]);

        // The input field is set to empty
        $this->reset('bodyReply');
        
        // We refresh the reply component data by calling a refreshed comment
        $this->comment = $this->comment->refresh();
    }

    public function render()
    {
        return view('livewire.comment-replies');
    }
}
