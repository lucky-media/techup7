<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Course;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // Search all instructor names with the search term provided by user.
    public function searchInstructors()
    {
        $data = request()->validate([
            'searchTerm' => 'required',
        ]);
        $searchTerm = $data['searchTerm'];

        $users = User::query()
                        ->where('name', 'LIKE', "%{$searchTerm}%") 
                        ->where('role', '=', "instructor")
                        ->orderBy('created_at', 'desc') 
                        ->paginate(9);

        return view('search.instructors', compact('users'));
    }

    // Search all courses where the title or the body has the search term provided by user.
    public function searchCourses()
    {
        $data = request()->validate([
            'searchTerm' => 'required',
        ]);
        $searchTerm = $data['searchTerm'];

        $courses = Course::query()
                        ->where('title', 'LIKE', "%{$searchTerm}%") 
                        ->orWhere('body', 'LIKE', "%{$searchTerm}%")
                        ->orderBy('created_at', 'desc') 
                        ->paginate(9);

        return view('search.courses', compact('courses'));
    }

    // Search all courses where the title or the body has the search term provided by user
    // and they belong to the instructor from where the search was invoked.
    public function searchCoursesByInstructor(User $user)
    {
        $data = request()->validate([
            'searchTerm' => 'required',
        ]);
        $searchTerm = $data['searchTerm'];

        $courses = Course::query()
                        ->where('user_id', "{$this->user->id}")
                        ->where(function($query) {
                            $query->where('title', 'LIKE', "%{$this->searchTerm}%") 
                                ->orWhere('body', 'LIKE', "%{$this->searchTerm}%");
                        })
                        ->orderBy('created_at', 'desc')
                        ->paginate(3);

        return view('search.CoursesByInstructor', compact('courses', 'user'));
    }

    // Search all lessons where the title or the body has the search term provided by user
    // and they belong to the course from where the search was invoked.
    public function searchLessonsByCourse(Course $course)
    {
        $data = request()->validate([
            'searchTerm' => 'required',
        ]);
        $searchTerm = $data['searchTerm'];

        $lessons = Lesson::query()
                        ->where('title', 'LIKE', "%{$searchTerm}%") 
                        ->orWhere('body', 'LIKE', "%{$searchTerm}%")
                        ->where('course_id', '=', "{$course->id}")
                        ->orderBy('created_at', 'desc') 
                        ->paginate(9);

        return view('search.lessonsByCourse', compact('lessons', 'course'));
    }
}
