<?php

namespace App\Http\Controllers;

use App;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function index()
    {
        $data = request()->validate([
            'locale' => 'required',
        ]);

        $locale = $data['locale'];

        if (auth()->user()){
            auth()->user()->settings->locale = $locale;
            auth()->user()->settings->save();
        }

        App::setLocale($locale);
        Carbon::setLocale($locale);
        //storing the locale in session to get it back in the middleware
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
