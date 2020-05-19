<?php

namespace App\Http\Controllers;

use App\Course;
use App\Category;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CoursesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function create()
    {
        $categories = Category::get();
        
        return view('courses.create', compact('categories'));
    }
    
    public function store()
    { 
        $data = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'required|image',
            'lang' => 'required',
            'category_id' => 'required',
        ]);
        
        $image = request()->file('image')->store('storage/uploads');
        Image::make($image)->fit(600,400)->save();

        $customSlug = Str::slug($data['title'], '-');

        if (Course::where('slug', $customSlug)->first()){
            $customSlug = $customSlug . '-' . rand(10,100);
        }
        
        auth()->user()->courses()->create([
            'title' => $data['title'],
            'slug' => $customSlug,
            'body' => $data['body'],
            'image' => $image,
            'lang' => $data['lang'],
            'category_id' => $data['category_id'],
        ]);
        
        return redirect('/profiles/'. auth()->user()->id);
    }

    public function destroy(Course $course)
    {
        foreach ($course->lesson as $lesson) {
            foreach ($lesson->children as $comment) {
                $comment->delete();
            }
            $lesson->delete();
        }
        
        File::delete(public_path("{$course->image}"));

        $course->delete();

        return redirect('/profiles/'. auth()->user()->id);
    }

    public function edit(Course $course)
    {
        $this->authorize('update', $course);

        $categories = Category::get();

        return view('courses.edit', compact('course', 'categories'));
    }

    public function update(Course $course)
    {
        $this->authorize('update', $course);
        
        $data = request()->validate([
            'id' => 'required',
            'title' => 'required',
            'body' => 'required',
            'image' => '',
            'lang' => 'required',
            'category_id' => 'required',
        ]);

        if (request('image'))
        {
            File::delete(public_path("{$course->image}"));
            
            $image = request()->file('image')->store('storage/uploads');
            Image::make($image)->fit(600,400)->save();

            $imageArray = ['image' => $image];
        }

        $titleChanged = Course::where('id', $data['id'])->first();

        if ($titleChanged->title != $data['title']){

            $customSlug = Str::slug($data['title'], '-');
            
            if (Course::where('slug', $customSlug)->first()){
                $customSlug = $customSlug . '-' . rand(10,100);
            }
        }
        else
        {
            $customSlug = $titleChanged->slug;
        }

        $data = [
            'title' => $data['title'],
            'slug' => $customSlug,
            'body' => $data['body'],
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
        return view('courses.show', compact('course'));
    }

    public function index()
    {
        $courses = Course::latest()->paginate(9);

        return view('courses.index', compact('courses'));
    }
}