<?php

namespace App\Http\Controllers;

use Purifier;
use App\Lesson;
use App\Course;
// use App\Comment;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class LessonsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    public function create(Course $course)
    {
        $this->middleware('role');

        return view('lessons.create', compact('course'));
    }
    
    public function store()
    {
        $this->middleware('role');

        $data = request()->validate([
            'course_id' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);

        $customSlug = Str::slug($data['title'], '-');

        if (Lesson::where('slug', $customSlug)->first()){
            $customSlug = $customSlug . '-' . rand(10,100);
        }

        Lesson::create([
            'course_id' => $data['course_id'],
            'title' => $data['title'],
            'slug' => $customSlug,
            'body' => Purifier::clean($data['body']),
        ]);

        $course = Course::where('id', $data['course_id'])->first();

        return redirect('/courses/'. $course->slug);   
    }

    public function destroy(Lesson $lesson)
    {
        $this->middleware('role');

        $courseSlug = $lesson->course->slug;

        $lesson->delete();
        
        return redirect('/courses/'. $courseSlug);
    }

    public function edit(Lesson $lesson)
    {
        $this->middleware('role');

        $this->authorize('update', $lesson);

        return view('lessons.edit', compact('lesson'));
    }

    public function update(Lesson $lesson)
    {
        $this->middleware('role');
        
        $data = request()->validate([
            'id' => 'required',
            'course_id' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);

        $titleChanged = Lesson::where('id', $data['id'])->first();

        if ($titleChanged->title != $data['title']){

            $customSlug = Str::slug($data['title'], '-');
            
            if (Lesson::where('slug', $customSlug)->first()){
                $customSlug = $customSlug . '-' . rand(10,100);
            }
        }
        else
        {
            $customSlug = $titleChanged->slug;
        }

        $lesson->update([
            'course_id' => $data['course_id'],
            'title' => $data['title'],
            'slug' => $customSlug,
            'body' => Purifier::clean($data['body']),
        ]);
        
        return redirect('/lessons/'. $customSlug);
    }

    public function show($slug)
    {
        $lesson = Lesson::where('slug', $slug)->first();
        
        $lessons = Lesson::where('course_id', $lesson->course->id)->get();
        
        //$comments = Comment::where('commentable_id', $lesson->id)->get();

        return view('lessons.show', compact('lesson', 'lessons'));
    }

    public function uploadImage(Request $request)
    {
        $imgpath = $request->file('file')->store('uploads', 'public');
        return response()->json(['location' => "/storage/$imgpath"]);
    }
}