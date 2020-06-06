<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }
    
    public function store()
    {
        $data = request()->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Mail::to($data['email'])->send(new ContactFormEmail($data));

        request()->session()->flash('message', 'Success!');

        return redirect('contact');
    }


}
