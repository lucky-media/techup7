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
                <form action="{{ route('profile.edit', $user) }}" enctype="multipart/form-data" method="get">
                        <button type="submit" 
                        class="transition duration-200 ease-in-out bg-orange-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                        {{ __('Update Profile') }}</button>
                </form>
            @endcan
        </div>
    </div>
</div>


<div class="container my-10">

    
    <div class="row">
        <div class="col-9">
            <div class="my-10">
                <h2 class="text-2xl font-semibold"> <strong>{{ $user->courses->count() }}</strong> Courses: </h2>
            </div>
        </div>
        @can('create', $user->profile)
        <div class="col-3">
            <div class="my-10">
                
                    <form action="{{ route('courses.create') }}" enctype="multipart/form-data" method="get">
                            <button type="submit" 
                            class="transition duration-200 ease-in-out bg-blue-500 font-bold text-white py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                            {{ __('Add New Course') }}</button>
                    </form>
                
            </div>
        </div>
        @endcan
    </div>

    <div class="row">
        @forelse($user->courses as $course)
        <div class="my-4 px-4 col-4">
            <article class="overflow-hidden rounded-lg shadow-lg">
                <a href="{{ route('courses.index', $course) }}">
                    <img alt="course cover" class="block h-64 w-full" src="/storage/{{ $course->image }}">
                </a>

                <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                    <h1 class="text-lg">
                        <a class="no-underline hover:underline text-black" href="{{ route('courses.index', $course) }}">
                            {{ $course->title }}
                        </a>
                    </h1>
                </header>

                <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                    <a class="flex items-center no-underline hover:underline text-black" href="{{ route('profile.index', $course->user->id) }}}}">
                        <img alt="profile photo" class="block rounded-full w-12 h-12" src="{{ $course->user->profile->profileImage() }}">
                        <p class="ml-2 text-sm">
                            {{ $course->user->name }}
                        </p>
                    </a>
                    <div class="no-underline text-grey-darker hover:text-red-dark">
                        {{ $course->updated_at->format('M Y') }}
                    </div>
                </footer>

            </article>
        </div>
        @empty
        <div>
            
        </div>
        @endforelse
    </div>
</div>

@endsection