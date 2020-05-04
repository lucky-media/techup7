<?php

namespace App\Http\Controllers;


use App\User;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function show(User $user)
    {   
        //This will redirect to home if the requested user profile is not that of an instructor
        if ($user->role == 'instructor'){
            $courses = Course::where('user_id', '=' , $user->id)->latest()->paginate(3);
            return view('profiles.show', compact('user', 'courses'));
        }
        else
        return view('index');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);
        
        $data = request()->validate([
            'bio' => 'required',
            'img' => '',
        ]);
        
        if (request('image'))
        {
            $imagePath = request('image')->store('uploads', 'public');
            
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(300,300);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }
        
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }

    public function index()
    {
        $users = User::where('role', '=' , "instructor")->latest()->paginate(6);

        return view('profiles.index', compact('users'));
    }
}