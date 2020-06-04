<?php

namespace App\Http\Controllers;

use Purifier;
use App\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        $posts = Post::latest()->paginate(9);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'required|string',
            'body' => 'required',
            'lang' => 'required',
        ]);

        // We create a slug from the title, but we also check for unique slug
        $customSlug = $this->createMySlug($data['title']);
        
        // The Purifier is used to check for malicious code and purifies the HTML code
        auth()->user()->posts()->create([
            'title' => $data['title'],
            'slug' => $customSlug,
            'body' => Purifier::clean($data['body']),
            'lang' => $data['lang'],
        ]);

        return redirect('/posts/'. $customSlug);
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = request()->validate([
            'title' => 'required|string',
            'body' => 'required',
            'lang' => 'required',
        ]);

        // We create a slug from the title
        $customSlug = Str::slug($data['title'], '-');

        // If the title has changed we create a new slug
        if ($post->slug != $customSlug) {
            $customSlug = $this->createMySlug($data['title']);
           }
        
        // The Purifier is used to check for malicious code and purifies the HTML code
        $post->update([
            'title' => $data['title'],
            'slug' => $customSlug,
            'body' => Purifier::clean($data['body']),
            'lang' => $data['lang'],
        ]);

        return redirect('/posts/'. $customSlug);        
    }

    public function destroy(Post $post)
    {
          // We search for all the images within the post body column
          preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', $post->body, $matches);
          if(!empty($matches[1])) {
              foreach($matches[1] as $match)
              {
                  $elements[] = $match;
              }
  
              // We format the images that we got from post body
              foreach($elements as $element){
                  $imagesWanted[] = 'storage/uploads/posts/'.pathinfo($element)["basename"];
              }
              
              // We delete the post images that were uploaded in the posts folder
              Storage::disk('local')->delete($imagesWanted);
          }
  
          // We delete all relationships of the post
          $post->children()->delete();
  
          // We delete the post
          $post->delete();

          return redirect('/blog');
    }

    // We upload the images that the user adds through the WYSIWYG editor
    public function uploadImage(Request $request)
    {
        $image = request()->file('file')->store('storage/uploads/posts');
        
        // We set the width of the image to 600 and auto height before saving
        Image::make($image)->resize(600, null, function ($constraint)
            {
                $constraint->aspectRatio();
            })->save();

        return response()->json(['location' => url($image)]);
    }

    // We make sure that the slug is always unique and it increases by 1
    public function createMySlug($title)
    {    
        $customSlug = Str::slug($title, '-');

        // We get all related slugs from the database
        $allSlugs = $this->getRelatedSlugs($customSlug);

        // If the slug is not used before, we return the result
        if (! $allSlugs->contains('slug', $customSlug)){
            return $customSlug;
        }
        
        // If there is a match, we see how many iterations of that slug exist
        // If we have "hello-world-7" then we create a slug "hello-world-8"
        for ($i = 1; $i <= 20; $i++) {
             $newSlug = $customSlug.'-'.$i;
             if (! $allSlugs->contains('slug', $newSlug)) {
                 return $newSlug;
            }
        }
    }

    // We get all related slugs from the Course table
    protected function getRelatedSlugs($slug)
    {
        return Post::select('slug')->where('slug', 'like', $slug.'%')->get();
    }

}
