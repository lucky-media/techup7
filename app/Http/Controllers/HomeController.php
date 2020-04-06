<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }
    
    public function courses()
    {
        return view('courses');
    }
    public function instructors()
    {
        return view('instructors');
    }
    public function blog()
    {
        return view('blog');
    }
    public function contact()
    {
        return view('contact');
    }
}
