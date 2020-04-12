<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use App\Lesson;
use App\Comment;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CoursesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    public function create()
    {
        return view('courses.create');
    }
    
    public function store()
    { 
        $data = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'required|image',
            'lang' => 'required',
        ]);
        
        $imagePath = request('image')->store('uploads','public');
        
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(300,300);
        $image->save();

        $customSlug = Str::slug($data['title'], '-');

        if (Course::where('slug', $customSlug)->first()){
            $customSlug = $customSlug . '-' . rand(10,100);
        }
        
        auth()->user()->courses()->create([
            'title' => $data['title'],
            'slug' => $customSlug,
            'body' => $data['body'],
            'image' => $imagePath,
            'lang' => $data['lang'],
        ]);
        
        return redirect('/profile/'. auth()->user()->id);
    }

    public function destroy(Course $course)
    {
        foreach ($course->lesson as $lesson) {
            foreach ($lesson->children as $comment) {
                $comment->delete();
            }
            $lesson->delete();
        }
        
        File::delete(public_path("storage/{$course->image}"));

        $course->delete();

        return redirect('/profile/'. auth()->user()->id);
    }

    public function edit(Course $course)
    {
        $this->authorize('update', $course);

        return view('courses.edit', compact('course'));
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
        ]);

        if (request('image'))
        {
            $imagePath = request('image')->store('uploads','public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(300,300);
            $image->save();    

            $imageArray = ['image' => $imagePath];
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
}