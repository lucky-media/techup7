@extends('layouts.app')

@section('content')

<div style="background:url('/storage/title_img.png'); ">
    <div class="container">
        <div class="row items-center justify-between py-20">
            <div class="col-4">
                <h2 class="text-4xl">Instructor Profile</h2>
            </div>
        </div>
    </div>
</div>

<div class="container my-20">
    <div class="row items-center">
        <div class="col-4">
            <img src="{{ $user->profile->profileImage() ?? 'svg/techup.svg' }}" class="rounded-lg">
        </div>
        <div class="col-6">
            <h2 class="font-semibold text-2xl text-orange-500 py-2">{{ $user->name }}</h2>
            <p class="py-1 text-justify"><strong>Bio:</strong> {{ $user->profile->bio ?? '' }}</p>
            <p class="py-1"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="py-1"><strong>Role:</strong> {{ $user->role }}</p>
            @can('update', $user->profile)
                <form action="/profile/{{ $user->id }}/edit" enctype="multipart/form-data" method="get">
                        <button type="submit" 
                        class="transition duration-200 ease-in-out bg-orange-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                        {{ __('Update Profile') }}</button>
                </form>
            @endcan
        </div>
    </div>
</div>


<div class="container my-10">

    @can('create', $user->profile)
    <div class="row">
        <div class="col-9">
            <div class="my-10">
                <h2 class="text-2xl font-semibold"> <strong>{{ $courseCount }}</strong> Courses: </h2>
            </div>
        </div>
        <div class="col-3">
            <div class="my-10">
                
                    <form action="/courses/create" enctype="multipart/form-data" method="get">
                            <button type="submit" 
                            class="transition duration-200 ease-in-out bg-blue-500 font-bold text-white py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                            {{ __('Add New Course') }}</button>
                    </form>
                
            </div>
        </div>
    </div>
    @endcan

    <div class="row">
        @forelse($user->courses as $course)
            <div class="col-4 items-center mb-12">
                <div class="container my-4">
                    <div class="row justify-center">
                        <div class="col-4">
                            <a href="/courses/{{ $course->slug }}">
                                <img src="/storage/{{ $course->image }}" class="rounded-top">
                            </a>
                        </div>
                        <div class="col-7">
                            <a href="/courses/{{ $course->slug }}">
                                <h2 class="text-2xl font-bold">{{ $course->title }}</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        <div>
            
        </div>
        @endforelse
    </div>
</div>

@endsection