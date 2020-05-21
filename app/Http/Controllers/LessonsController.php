<?php

namespace App\Http\Controllers;

use Purifier;
use App\Lesson;
use App\Course;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class LessonsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
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
        
        $lesson = Lesson::create([
            'course_id' => $data['course_id'],
            'title' => $data['title'],
            'slug' => $customSlug,
            'body' => Purifier::clean($data['body']),
        ]);

        return redirect('/lessons/'. $lesson->slug);
    }

    public function destroy(Lesson $lesson)
    {
        $this->middleware('role');

        $courseSlug = $lesson->course->slug;

        preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', $lesson->body, $matches);
        if(!empty($matches[1])) {
            foreach($matches[1] as $match)
            $elements[] = $match;
        }
        
        foreach($elements as $element){
            $imagesWanted[] = 'storage/uploads/lessons/'.pathinfo($element)["basename"];
        }
        
        Storage::disk('local')->delete($imagesWanted);
        
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
        $image = request()->file('file')->store('storage/uploads/lessons');
        
        Image::make($image)->resize(600, null, function ($constraint)
            {
                $constraint->aspectRatio();
            })->save();

        return response()->json(['location' => url($image)]);
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