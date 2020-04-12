@extends('layouts.app')

@section('content')

<div style="background:url('/storage/title_img.png'); ">
    <div class="container">
        <div class="row items-center justify-between py-20">
            <div class="col-6">
                <h2 class="text-4xl"> {{ $course->title }} </h2>
            </div>
        </div>
    </div>
</div>

<div class="container my-4">
    <div class="row">
        <div class="col-8">
            <div class="text-sm">
                By <a href="/profile/{{ $course->user->id }}" class="text-blue-500">{{ $course->user->name }}</a>, last update on {{ $course->updated_at->format('M Y') }}
            </div>
        </div>
        <div class="col-3">
            <div class="row">
                <div class="col-6 px-4">
                    @can('update', $course)    
                    <form action="/courses/{{ $course->id }}/edit" enctype="multipart/form-data" method="get">
                            <button type="submit" 
                            class="transition duration-200 ease-in-out bg-orange-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                            {{ __('Edit') }}</button>
                    </form>
                    @endcan
                </div>

                <div class="col-6 px-4">
                    @can('delete', $course)
                    <form action="/courses/{{ $course->id }}" enctype="multipart/form-data" method="post">
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

<div class="container my-20">
    <div class="row">
        <div class="col-7 text-justify">
            <img src="/storage/{{ $course->image }}" class="rounded-circle" alt="course cover">
            <p class="py-6">{!! $course->body !!}</p>
        </div>
        <div class="col-5">
            <h2 class="text-white font-bold text-2xl bg-blue-500 px-8 py-5">{{ $course->title }}</h2>
            @forelse($course->lesson as $lesson)
                    <a href="/lessons/{{ $lesson->slug }}">
                        <h2 class="text-black bg-gray-100 px-8 py-5 border-b-2 border-white">{{ $lesson->title }}</h2>    
                    </a>
            @empty
                <p>There are no lessons yet.</p>
            @endforelse
            <br>
            @can('create', $course)
                <div>
                    <form action="/lessons/create/{{ $course->slug }}" enctype="multipart/form-data" method="get">
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
