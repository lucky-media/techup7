<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index(User $user)
    {       
        $courseCount = Cache::remember(
            'count.courses.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->courses->count();
            });        

        return view('profiles.index', compact('user', 'courseCount'));
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
}