<?php

namespace App\Http\Controllers;


use App\User;
use App\Course;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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
            $courses = Course::where("user_id", $user->id)->latest()->paginate(3);
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
            'image' => '',
        ]);
        
        if (request('image'))
        {
            $image = request()->file('image')->store('storage/uploads');
            Image::make($image)->fit(300)->save();

            $imageArray = ['image' => $image];
        }
        
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect(route('profiles.show', $user->id));
    }

    public function index()
    {
        $users = User::where('role', '=' , "instructor")->latest()->paginate(6);

        return view('profiles.index', compact('users'));
    }
}