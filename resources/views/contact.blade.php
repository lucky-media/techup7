@extends('layouts.app')

@section('content')
<div style="background:url({{ asset('/storage/title_img.png') }}); ">
    <div class="container">
        <div class="row items-center justify-between py-20">
            <div class="col-4">
                <h2 class="text-4xl"> {{ __('contact.contact') }} </h2>
            </div>
        </div>
    </div>
</div>
<div class="container my-20">
    <div class="row justify-center text-center">
        <div class="col-10">{{ __('contact.we_are_ready_to_help') }}</div>
    </div>
</div>
<div class="container mt-40">
    <div class="row">
        <div class="lg:col-6">
            <h2 class="font-bold text-4xl">{{ __('contact.send_us_a_message') }}</h2>
        </div>
    </div>
</div>

@if ( session('success'))
    <div class="container my-4">
        <div class="row">
            <div class="lg:col-6">
                <h2 class="font-bold">{{ session('success') }}</h2>
            </div>
        </div>
    </div>
@endif 

<form action="/send/email" enctype="multipart/form-data" method="get">
    {{ csrf_field() }}

    <div class="container mt-5">
        <div class="row">
            <div class="lg:col-6">
                <input class="mt-5 bg-gray-100 py-6 pl-10 w-full @error('fname') border-2 border-red-600 @enderror"
                type="text" placeholder="{{ __('contact.first_name') }}" id="fname" name="fname" value="{{ old('fname') }}" required autofocus />
                
                @error('fname')
                <span role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
                @enderror
            </div>

            <div class="lg:col-6">
                <input class="mt-5 bg-gray-100 py-6 pl-10 w-full @error('fname') border-2 border-red-600 @enderror"
                type="text" placeholder="{{ __('contact.last_name') }}" id="lname" name="lname" value="{{ old('lname') }}" required />
                
                @error('lname')
                <span role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
                @enderror
            </div>

            <div class="lg:col-6">
                <input class="mt-5 bg-gray-100 py-6 pl-10 w-full @error('fname') border-2 border-red-600 @enderror"
                type="text" placeholder="{{ __('contact.email_address') }}" id="email" name="email" value="{{ old('email') }}" required />

                @error('email')
                <span role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
                @enderror
            </div>

            <div class="lg:col-6">
                <input class="mt-5 bg-gray-100 py-6 pl-10 w-full @error('fname') border-2 border-red-600 @enderror"
                type="text" placeholder="{{ __('contact.subject') }}" id="subject" name="subject" value="{{ old('subject') }}" required />

                @error('subject')
                <span role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
                @enderror
            </div>

            <div class="col-12">
                <textarea class="bg-gray-100 py-6 pl-10 w-full @error('fname') border-2 border-red-600 @enderror mt-5"
                id="message" name="message" rows="5" value="{{ old('message') }}"
                    placeholder="{{ __('contact.message') }}" required></textarea>

                @error('message')
                <span role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
                @enderror

                <button class="my-6 bg-blue-500 text-white text-center w-full py-5">
                    {{ __('general.send') }}
                </button>
                
            </div>
        </div>
    </div>
</form>

<div class="container mt-24">
    <div class="row">
        <div class="col-12">
            <h2 class="font-bold text-4xl ">{{ __('contact.faq') }}</h2>
            <p>{{ __('contact.some_of_the_most') }}</p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="w-ful h-auto lg:col-6 my-8">
            <img src="{{ asset('/storage/contact_img.png') }}" alt="Contact_img">
        </div>
    </div>
</div>
<div class="container">
    <div class="row text-center">
        <div class="lg:col-4 text-justify">
            <h2 class="font-bold text-lg">{{ __('contact.are_the_courses') }}</h2>
            <p>{{ __('contact.yes_the_courses') }}
            </p>
        </div>
        <div class="lg:col-4 text-justify">
            <h2 class="mt-5 lg:mt-0 font-bold text-lg">{{ __('contact.where_do_the_materials') }}</h2>
            <p>{{ __('contact.the_materials_do_not') }}</p>
        </div>
        <div class="lg:col-4 text-justify">
            <h2 class="mt-5 lg:mt-0 font-bold text-lg">{{ __('contact.are_there_any_age') }}</h2>
            <p>{{ __('contact.the_course_will_mostly') }}</p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row text-center mt-5 mb-10 lg:mt-10 lg:mb-24">
        <div class="lg:col-4 text-justify">
            <h2 class="mt-5 lg:mt-0 font-bold text-lg">{{ __('contact.are_there_any_offline') }}</h2>
            <p>{{ __('contact.yes_techup_started') }}</p>
        </div>
        <div class="lg:col-4 text-justify">
            <h2 class="mt-5 lg:mt-0 font-bold text-lg">{{ __('contact.are_there_any_previous') }}</h2>
            <p>{{ __('contact.no_there_are_not') }}</p>
        </div>
        <div class="lg:col-4 text-justify">
            <h2 class="mt-5 lg:mt-0 font-bold text-lg">{{ __('contact.can_these_courses_be') }}</h2>
            <p>{{ __('contact.to_some_extent_yes') }}</p>
        </div>
    </div>
</div>
@endsection
