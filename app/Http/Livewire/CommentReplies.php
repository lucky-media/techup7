<?php

namespace App\Http\Livewire;

use App\Notifications\NewComment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use App\Comment;

class CommentReplies extends Component
{
    public $comment;
    public $bodyReply;
    public $commentable;
    public $liked = 0;
    public $totalLikes;
    public $profileImage;

    // The listener is used to refresh the component if a comment is deleted or flagged
    protected $listeners = ['refresh' => '$refresh'];
    
    public function mount(Comment $comment)
    {
        $this->comment = $comment;
        $this->commentable = $comment->commentable;

        $this->profileImage = Cache::rememberForever
                ('profileImage.' . $comment->user->id, function () use ($comment) {
                    return $comment->user->profile->profileImage();
                });

        if (auth()->user()){
            $this->liked = $this->getLike();
        }

        $this->totalLikes = $this->getTotalLikes();
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

    // Approve flagged comment
    public function approveComment()
    {
        $this->comment->update([
            'approved' => true,
        ]);
    }

    // Replying a comment is done by adding the parent id
    public function replyComment()
    {
        $data = $this->validate([
            'bodyReply' => 'required|min:2',
        ]);
                
        $this->commentable->comments()->create([
            'user_id' => auth()->user()->id,
            'parent_id' => $this->comment->id,
            'body' => $data['bodyReply'],
        ]);

        // The input field is set to empty
        $this->reset('bodyReply');
        
        $this->sendNotification($data['bodyReply']);

        // We refresh the reply component data by calling a refreshed comment collection
        $this->comment = $this->comment->refresh();

        // Refreshing the component parent, because this comment is deleted
        $this->emitUp('refresh');

    }

    // Check if user has liked this comment
    private function getLike(){
        $data = DB::table('comment_user')
                                ->where('user_id', auth()->user()->id)
                                ->where('comment_id', $this->comment->id)
                                ->count();
        return $data;
    }

    // Like the comment
    public function likeComment()
    {
        $this->comment->likes()->toggle(auth()->user()->id);
        
        $this->liked = $this->getLike();

        // Refreshing the component parent
        $this->emitUp('refresh');
    }

    // Get total likes for this comment
    private function getTotalLikes(){
        $data = DB::table('comment_user')
                                ->where('comment_id', $this->comment->id)
                                ->count();
        return $data;
    }

    // Send notification to content owner
    public function sendNotification($data)
    {
        // Info about the user adding the comment
        $info['name'] = auth()->user()->name;
        $info['email'] = auth()->user()->email;
        $info['comment'] = $data;
        $info['url'] = asset('/').'courses/'.$this->commentable->slug;

        // Notify the comment owner if he has enabled emails on the settings
        if ($this->comment->user->settings->new_reply){
            $this->comment->user->notify(new NewComment($info));
        }
    }

    public function render()
    {
        return view('livewire.comment-replies');
    }
}
