<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // The admin can view all the users and manage their roles
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
        
        $user->update(request()->validate([
            'role' => 'required',
        ]));

        return redirect("/admin");
    }

    public function destroy(User $user)
    {
        $this->middleware('role');

        $user->delete();
        
        return redirect('/admin');
    }
}