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
                    
                    <input id="searchTerm" type="text" name="searchTerm" class="rounded bg-gray-100 border-2 border-orange-500 py-2 pl-2 text-black w-4/12" required>
                    <button type="submit" 
                        class="transition duration-200 ease-in-out font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                        Search</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- List all lessons where the title or the body has the search term that the user provided --}}
<div class="container my-20">
    <div class="row">
        <div class="col-12 text-justify">
            @forelse($lessons->reverse() as $lesson)
                    <a href="{{ route('lessons.show', $lesson->slug) }}">
                        <h2 class="text-white font-bold text-2xl bg-blue-500 px-8 py-5">{{ $lesson->title }}</h2>
                    </a>
                    <a href="{{ route('lessons.show', $lesson->slug) }}">
                        <h2 class="text-black bg-gray-100 px-8 py-5 border-b-2 border-white mb-10">{!! Str::limit($lesson->body, 350) !!}</h2>
                    </a>
            @empty
                <p>There are no lessons with the search term you searched for.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
