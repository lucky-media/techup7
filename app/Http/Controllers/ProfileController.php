<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function show(User $user)
    {   
        //This will return back if the requested user profile is for the admin
        if ($user->role == 'admin'){
            return back();
        }
        else
        {
            if (!Cache::has('profileImage.'.$user->id)){
            $profileImage = Cache::rememberForever
                ('profileImage.' . $user->id, function () use ($user) {
                    return $user->profile->profileImage();
                });  
            }
            else
            {
                $profileImage = Cache::get('profileImage.'.$user->id);
            }
            $coursesCount = Cache::rememberForever
                ('coursesCount.' . $user->id, function () use ($user) {
                    return $user->courses->count();
                });

            return view('profiles.show', compact('user', 'profileImage', 'coursesCount'));
        }
    }

    public function edit(User $user)
    {
        // Editing is authorized only if the user has a profile
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    // Each instructor can update their own profile
    public function update(User $user)
    {
        // Updating is authorized only if the user has a profile
        $this->authorize('update', $user->profile);
        
        $data = request()->validate([
            'bio' => 'required',
            'image' => '',
        ]);
        
        // This part executes only if the instructor wants to change the profile image
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

        Cache::forget('profileImage.'.$user->id);
        Cache::forget('user.'.$user->id);

        return redirect(route('profiles.show', $user->id));
    }

    public function index()
    {
        return view('profiles.index');
    }
}