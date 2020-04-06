@extends('layouts.app')

@section('content')


<div style="background:url('/storage/title_img.png'); ">
    <div class="container">
        <div class="row items-center justify-between py-20">
            <div class="col-6">
                <h2 class="text-4xl"> All Courses </h2>
            </div>
        </div>
    </div>
</div>

<div class="container my-12 mx-auto px-4 md:px-12">
    <div class="flex flex-wrap -mx-1 lg:-mx-4">
        @foreach($courses as $course)
         <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
            <article class="overflow-hidden rounded-lg shadow-lg">
                <a href="/courses/{{ $course->slug }}">
                    <img alt="course cover" class="block h-64 w-auto" src="/storage/{{ $course->image }}">
                </a>

                <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                    <h1 class="text-lg">
                        <a class="no-underline hover:underline text-black" href="/courses/{{ $course->slug }}">
                            {{ $course->title }}
                        </a>
                    </h1>
                </header>

                <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                    <a class="flex items-center no-underline hover:underline text-black" href="/profile/{{ $course->user->id }}">
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
        @endforeach
    </div>
</div>

@endsection
