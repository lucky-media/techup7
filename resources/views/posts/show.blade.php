@extends('layouts.app')

@section('content')

{{-- The owner of the post can edit or delete post--}}
<div class="container my-4">
    <div class="row">
        <div class="col-3">
            <div class="row">
                <div class="col-6 px-4">
                    @can('update', $post)
                    <form action="{{ route('posts.edit', $post) }}" enctype="multipart/form-data" method="get">
                            <button type="submit"
                            class="transition duration-200 ease-in-out bg-orange-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                            {{ __('general.edit') }}</button>
                    </form>
                    @endcan
                </div>

                <div class="col-6 px-4">
                    @can('delete', $post)
                    <form action="{{ route('posts.destroy', $post) }}" enctype="multipart/form-data" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" onclick="return confirm('{{ __('general.are_you_sure') }}')"
                            class="transition duration-200 ease-in-out bg-blue-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                            {{ __('general.delete') }}</button>
                    </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>

{{-- We display all posts with a link, date created, owner and language --}}
<div class="container">
    <div class="row justify-center">
        <div class="lg:col-10 mt-8">
            <div class="py-4 px-8 shadow-lg rounded-lg mt-20 bg-orange-500">
                <div class="flex float-right -mt-16">
                    <img class="w-20 h-20 object-cover rounded-full border-2 border-indigo-500" alt="{{ asset($post->user->name) }}"
                        src="{{ asset($post->user->profile->profileImage()) }}">
                </div>
                <div>
                    <h2 class="text-gray-800 text-3xl font-semibold">
                            {{ $post->title }}
                    </h2>
                    <p class="mt-2 text-gray-600">
                        {!! $post->body !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Answer section --}}
<livewire:add-answer :post="$post">

@endsection
