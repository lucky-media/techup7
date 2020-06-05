@extends('layouts.app')
    
@section('content')

<div style="background:url({{ asset('/storage/title_img.png') }}); ">
    <div class="container">
        <div class="row items-center justify-between py-20">
            <div class="col-6">
                <h2 class="text-4xl">{{ __('general.blog') }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="container my-12 mx-auto px-4 md:px-12">
    <div class="flex flex-wrap -mx-1 lg:-mx-4">
        <input type="text" class="rounded bg-gray-100 border-2 mr-4 border-orange-500" wire:model.debounce.500ms="searchTerm" />
        <p>search with livewire. Show only in:</p>
        <button class="bg-blue-500 font-bold text-white px-2 py-1 rounded ml-4"
                wire:click="switchLanguage('sq')">{{ __('general.albanian') }}</button>
        <button class="bg-orange-500 font-bold text-white px-2 py-1 rounded ml-4"
                wire:click="switchLanguage('mk')">{{ __('general.macedonian') }}</button>
        <button class="bg-gray-500 font-bold text-white px-2 py-1 rounded ml-4"
                wire:click="switchLanguage()">{{ __('general.both') }}</button>
        @auth
            <div>
                <form action="{{ route('posts.create') }}" enctype="multipart/form-data" method="get">
                    <button type="submit"
                    class="transition duration-200 ease-in-out bg-blue-500 font-bold text-white py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600 ml-4">
                    {{ __('general.add_new_post') }}</button>
                </form>
            </div>
        @endauth
    </div>
</div>

{{-- We display all posts with a link, date created, owner and language --}}
<div class="container">
    <div class="row justify-center">
        @foreach($posts as $post)
        <div class="lg:col-8 mt-8">
            <div class="py-4 px-8 shadow-lg rounded-lg my-20
            {{ ($post->best_answer) ? 'bg-orange-500' : 'bg-white' }}
            ">
                <div class="flex float-right -mt-16">
                    <img class="w-20 h-20 object-cover rounded-full border-2 border-indigo-500" alt="{{ asset($post->user->name) }}"
                        src="{{ asset($post->user->profile->profileImage()) }}">
                </div>
                <div>
                    <a class="no-underline hover:underline text-black" href="{{ route('posts.show', $post->slug) }}">
                        <h2 class="text-gray-800 text-3xl font-semibold">
                            {{ Str::limit($post->title, 30) }}
                        </h2>
                        <p class="mt-2 text-gray-600">
                            {!! Str::of(strip_tags($post->body))->limit(300) !!}
                        </p>
                    </a>
                </div>
                <div class="flex justify-between items-center mt-4">
                    <div class="flex items-end mt-4">                        
                        <a href="{{ route('profiles.show', $post->user->id) }}" class="ml-4 text-xl font-medium text-indigo-500">
                            {{ Str::limit($post->user->name, 15) }}
                        </a>
                        <p class="ml-8 text-gray-600">{{ $post->created_at->diffForHumans() }}</p>
                        <p class="ml-8 text-gray-600">Total comments: {{ $post->answersCount() }}</p>
                        <p class="ml-8 text-gray-600">Status: <strong>{{ ($post->best_answer) ? 'Solved' : 'Unsolved' }}</strong></p>
                    </div>
                    <div class="float-right mt-4">
                        <img class="w-10 h-10 object-cover rounded-full border-2 border-indigo-500" alt="{{ $post->lang }}"
                            src="{{ asset('/storage/'.$post->lang.'.png') }}">
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row justify-center mt-4">
        <div class="col-6 justify-content-center">  
            {{ $posts->links() }}
        </div>
    </div>
</div>

{{-- <livewire:search-posts> --}}

@endsection