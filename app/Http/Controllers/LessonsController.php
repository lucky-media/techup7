<?php

namespace App\Http\Controllers;

use Purifier;
use App\Lesson;
use App\Course;
use App\Comment;

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

        $customSlug = $this->createMySlug($data['title']);

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

        $lesson->children()->delete();

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
            'title' => '',
            'body' => '',
        ]);

        $customSlug = Str::slug($data['title'], '-');

        if ($lesson->slug != $customSlug) {
            $customSlug = $this->createMySlug($data['title']);
           }

        $lesson->update([
            'title' => $data['title'],
            'slug' => $customSlug,
            'body' => Purifier::clean($data['body']),
        ]);
        
        return redirect('/lessons/'. $customSlug);
    }

    public function show(Lesson $lesson)
    {
        return view('lessons.show', compact('lesson'));
    }

    public function uploadImage(Request $request)
    {
        $imgpath = $request->file('file')->store('uploads', 'public');
        return response()->json(['location' => "/storage/$imgpath"]);
    }

    public function createMySlug($title)
    {    
        $customSlug = Str::slug($title, '-');

        $allSlugs = $this->getRelatedSlugs($customSlug);

        if (! $allSlugs->contains('slug', $customSlug)){
            return $customSlug;
        }
        
        for ($i = 1; $i <= 10; $i++) {
             $newSlug = $customSlug.'-'.$i;
             if (! $allSlugs->contains('slug', $newSlug)) {
                 return $newSlug;
            }
        }
    }

    protected function getRelatedSlugs($slug)
    {
        return Lesson::select('slug')->where('slug', 'like', $slug.'%')->get();
    }
}