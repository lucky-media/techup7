<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->middleware('role');

        $students = User::where('role', '=', 'student')->latest()->paginate(2, ['*'], 'students');
        $instructors = User::where('role', '=', 'instructor')->latest()->paginate(2, ['*'], 'instructors');
        
        return view('admin.index', compact('students', 'instructors'));
    }

    public function edit(User $user)
    {
        $this->middleware('role');

        return view('admin.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->middleware('role');
        
        $data = request()->validate([
            'role' => 'required',
        ]);

        $user->update([
            'role' => $data['role'],
        ]);

        if ($data['role'] == 'student'){
            $user->profile()->delete();
        }
        else
        {
            $user->profile()->create([
                'bio' => 'Some personal information',
                'image' => 'uploads/noimage.png',
            ]);
        }

        return redirect("/admin");
    }

    public function destroy(User $user)
    {
        $this->middleware('role');

        $user->delete();
        
        return redirect('/admin');
    }
}