<?php

namespace App\Http\Controllers;

use Purifier;
use App\Course;
use App\Category;
use App\Lesson;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function create()
    {
        $this->middleware('role');

        $categories = Category::get();
        
        return view('courses.create', compact('categories'));
    }
    
    public function store()
    { 
        $this->middleware('role');

        $data = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'required|image',
            'lang' => 'required',
            'category_id' => 'required',
        ]);
        
        // We get the uploaded image and store it in the storage/uploads folder
        // With intervention image we change the dimensions to 600x400 and we save it
        $image = request()->file('image')->store('storage/uploads');
        Image::make($image)->fit(600,400)->save();

        // We create a slug from the title, but we also check for unique slug
        $customSlug = $this->createMySlug($data['title']);
        
        auth()->user()->courses()->create([
            'title' => $data['title'],
            'slug' => $customSlug,
            'body' => Purifier::clean($data['body']),
            'image' => $image,
            'lang' => $data['lang'],
            'category_id' => $data['category_id'],
        ]);
        
        return redirect('/profiles/'. auth()->user()->id);
    }

    public function destroy(Course $course)
    {
        $this->middleware('role');

        // We delete all the relationships of the course such as lessons and comments
        foreach ($course->lesson as $lesson) {
            foreach ($lesson->children as $comment) {
                $comment->delete();
            }
            $lesson->delete();
        }
        
        // The cover image of the course is deleted from the folder
        File::delete(public_path("{$course->image}"));

        $course->delete();

        return redirect('/profiles/'. auth()->user()->id);
    }

    public function edit(Course $course)
    {
        $this->middleware('role');
        
        $this->authorize('update', $course);

        $categories = Category::get();

        return view('courses.edit', compact('course', 'categories'));
    }

    public function update(Course $course)
    {
        $this->middleware('role');
        
        $this->authorize('update', $course);
        
        $data = request()->validate([
            'id' => 'required',
            'title' => 'required',
            'body' => 'required',
            'image' => '',
            'lang' => 'required',
            'category_id' => 'required',
        ]);

        // During the update we check if the user wants to change the cover image
        if (request('image'))
        {            
            $image = request()->file('image')->store('storage/uploads');
            Image::make($image)->fit(600,400)->save();

            $imageArray = ['image' => $image];

            // We delete the old cover image from folder after successfully uploading new image
            File::delete(public_path("{$course->image}"));
        }

         // We create a slug from the title
         $customSlug = Str::slug($data['title'], '-');

         // If the title has changed we create a new slug
         if ($lesson->slug != $customSlug) {
             $customSlug = $this->createMySlug($data['title']);
            }

        $data = [
            'title' => $data['title'],
            'slug' => $customSlug,
            'body' => Purifier::clean($data['body']),
            'lang' => $data['lang'],
            'category_id' => $data['category_id'],
        ];
               
        $course->update(array_merge(
            $data,
            $imageArray ?? []
        ));
        
        return redirect('/courses/'. $course->$customSlug);
    }

    public function show(Course $course)
    {
        $lessons = Lesson::where('course_id', $course->id);

        return view('courses.show', compact('course', 'lessons'));
    }

    public function index()
    {
        $courses = Course::latest()->paginate(9);

        return view('courses.index', compact('courses'));
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
        return Course::select('slug')->where('slug', 'like', $slug.'%')->get();
    }

}