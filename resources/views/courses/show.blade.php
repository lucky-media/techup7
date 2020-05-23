@extends('layouts.app')

@section('content')

<div style="background:url({{ asset('/storage/title_img.png') }}); ">
    <div class="container">
        <div class="row items-center justify-between py-20">
            <div class="col-6">
                <h2 class="text-4xl"> {{ $course->title }} </h2>
            </div>
            <div class="col-6">
                <form action="{{ route('search.lessonsByCourse', $course) }}" method="POST">
                    {{ csrf_field() }}
                    
                    <input id="searchTerm" type="text" name="searchTerm" class="rounded bg-gray-100 border-2 border-orange-500 py-2 pl-2 text-black w-4/12">
                    <button type="submit" 
                        class="transition duration-200 ease-in-out font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                        Search</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- The owner of the course can edit or delete --}}
<div class="container my-4">
    <div class="row">
        <div class="col-8">
            <div class="text-sm">
                By <a href="{{ route('profiles.show', $course->user->id) }}" class="text-blue-500">{{ $course->user->name }}</a>, last update on {{ $course->updated_at->format('M Y') }}
            </div>
        </div>
        <div class="col-3">
            <div class="row">
                <div class="col-6 px-4">
                    @can('update', $course)
                    <form action="{{ route('courses.edit', $course) }}" enctype="multipart/form-data" method="get">
                            <button type="submit"
                            class="transition duration-200 ease-in-out bg-orange-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                            {{ __('Edit') }}</button>
                    </form>
                    @endcan
                </div>

                <div class="col-6 px-4">
                    @can('delete', $course)
                    <form action="{{ route('courses.destroy', $course) }}" enctype="multipart/form-data" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" onclick="return confirm('Are you sure?')"
                            class="transition duration-200 ease-in-out bg-blue-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                            {{ __('Delete') }}</button>
                    </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>

{{-- We display the course with the cover image, body and a list of all lessons belonging to that course --}}
<div class="container my-20">
    <div class="row">
        <div class="col-7 text-justify">
            <img src="{{ asset($course->image) }}" class="rounded-circle" alt="course cover">
            <p class="py-6">{!! $course->body !!}</p>
        </div>
        <div class="col-5">
            <h2 class="text-white font-bold text-2xl bg-blue-500 px-8 py-5">{{ $course->title }} &nbsp;
                <span class="text-sm font-normal"> ( {{ $course->lesson->count() }} lessons ) </span>
            </h2>
            @forelse($course->lesson->reverse() as $lesson)
                    <a href="{{ route('lessons.show', $lesson->slug) }}">
                        <h2 class="text-black bg-gray-100 px-8 py-5 border-b-2 border-white">{{ $lesson->title }}</h2>
                    </a>
            @empty
                <p>There are no lessons yet.</p>
            @endforelse
            <br>
            @can('create', $course)
                <div>
                    <form action="{{ route('lessons.create', $course) }}" enctype="multipart/form-data" method="get">
                        <button type="submit"
                        class="transition duration-200 ease-in-out bg-blue-500 font-bold text-white py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                        {{ __('Create New Lesson') }}</button>
                    </form>
                </div>
            @endcan
        </div>
    </div>
</div>

@endsection
