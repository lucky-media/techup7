@extends('layouts.app')

@section('content')


<div style="background:url({{ asset('/storage/title_img.png') }}); ">
    <div class="container">
        <div class="row items-center justify-between py-20">
            <div class="col-6">
                <h2 class="text-4xl"> Search Courses </h2>
            </div>
            <div class="col-6">
                <form action="{{ route('search.courses') }}" method="POST">
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

{{-- List all courses where the title or the body has the search term that the user provided --}}
<div class="container my-12 mx-auto px-4 md:px-12">
    <div class="flex flex-wrap -mx-1 lg:-mx-4">
        @forelse($courses as $course)
         <div class="my-4 px-4 col-4">
            <article class="overflow-hidden rounded-lg shadow-lg">
                <a href="{{ route('courses.show', $course->slug) }}">
                    <img alt="course cover" class="block h-64 w-full" src="{{ asset($course->image) }}">
                </a>

                <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                    <h1 class="text-lg">
                        <a class="no-underline hover:underline text-black" href="{{ route('courses.show', $course->slug) }}">
                            {{ Str::limit($course->title, 30) }}
                        </a>
                    </h1>
                </header>

                <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                    <a class="flex items-center no-underline hover:underline text-black" href="{{ route('profiles.show', $course->user->id) }}">
                        <img alt="profile photo" class="block rounded-full w-12 h-12" src="{{ asset($course->user->profile->profileImage()) }}">
                        <p class="ml-2 text-sm">
                            {{ Str::limit($course->user->name, 20) }}
                        </p>
                    </a>
                    <div class="no-underline text-grey-darker text-right text-sm hover:text-red-dark">
                            {{ $course->created_at->format('M Y') }}<br>
                        <a class="no-underline hover:underline text-black" href="{{ route('courses.index') }}">
                            {{ Str::limit($course->category->name, 10) }}
                        </a>
                    </div>
                </footer>

            </article>
        </div>
        @empty
        <div>
            We couldn't find a course with that search term.
        </div>
    @endforelse
    </div>
    <div class="row justify-center mt-4">
        <div class="col-6 justify-content-center">
            {{ $courses->links() }}
        </div>
    </div>
</div>

@endsection
