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

class LessonController extends Controller
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

        // We create a slug from the title, but we also check for unique slug
        $customSlug = $this->createMySlug($data['title']);
        
        // The Purifier is used to check for malicious code and purifies the HTML code
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

        // We search for all the images within the lesson body column
        preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', $lesson->body, $matches);
        if(!empty($matches[1])) {
            foreach($matches[1] as $match)
            $elements[] = $match;
        }
        
        // We format the images that we got from lesson body
        foreach($elements as $element){
            $imagesWanted[] = 'storage/uploads/lessons/'.pathinfo($element)["basename"];
        }
        
        // We delete the lesson images that were uploaded in the lessons folder
        Storage::disk('local')->delete($imagesWanted);
        
        // We delete all relationships of the lesson
        $lesson->children()->delete();

        // We delete the lesson
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

        // We create a slug from the title
        $customSlug = Str::slug($data['title'], '-');

        // If the title has changed we create a new slug
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

    // We upload the images that the user adds through the WYSIWYG editor
    public function uploadImage(Request $request)
    {
        $image = request()->file('file')->store('storage/uploads/lessons');
        
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

    // We get all related slugs from the Lesson table
    protected function getRelatedSlugs($slug)
    {
        return Lesson::select('slug')->where('slug', 'like', $slug.'%')->get();
    }

    // This function arranges the lessons of a course by moving the lesson up
    public function arrangeUp($courseSlug, $position)
    {
        
        $this->middleware('role');

        $course = Course::whereSlug($courseSlug)->first();
        
        $previousLesson = Lesson::where('course_id', '=', $course->id)->where('position', '=', $position-1)->first();
        $currentLesson = Lesson::where('course_id', '=', $course->id)->where('position', '=', $position)->first();
        
        $previousLesson->position = $position;
        $currentLesson->position = $position-1;

        $previousLesson->save();
        $currentLesson->save();
        
        return view('courses.show', compact('course'));
    }

    // This function arranges the lessons of a course by moving the lesson down
    public function arrangeDown($courseSlug, $position)
    {
        $this->middleware('role');

        $course = Course::whereSlug($courseSlug)->first();
        
        $nextLesson = Lesson::where('course_id', '=', $course->id)->where('position', '=', $position+1)->first();
        $currentLesson = Lesson::where('course_id', '=', $course->id)->where('position', '=', $position)->first();
        
        $nextLesson->position = $position;
        $currentLesson->position = $position+1;

        $nextLesson->save();
        $currentLesson->save();
        
        return view('courses.show', compact('course'));
    }
}