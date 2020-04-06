@extends('layouts.app')

@include('partials.tiny')

@section('content')
<div class="container my-10">
    <div class="row justify-center">
        <div class="col-10">
            <div class="bg-blue-500 border rounded mb-10 lg:mb-0">
                <div class="m-10">
                    <h2 class="text-4xl font-bold text-white">Edit Course</h2>

                    <form action="/courses/{{ $course->id }}" enctype="multipart/form-data" method="post">

                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="id" value="{{ old('id') ?? $course->id }}">

                        <div class="col-md-6 mb-5">
                            <label for="title" class="text-small text-white">Title</label>
                            <input id="title" type="text" class="rounded bg-gray-100 py-6 pl-2 text-black w-full
                            @error('title') border-2 border-red-600 @enderror" name="title"
                                value="{{ old('title') ?? $course->title }}" required autofocus>

                            @error('title')
                            <span role="alert">
                                <strong>{{ $message }}</strong><br>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-5">
                            <label for="body" class="text-small text-white">Body</label>
                            <input id="body" class="w-full" name="body" value="{{ old('body') ?? $course->body }}">

                            @error('body')
                            <span role="alert">
                                <strong>{{ $message }}</strong><br>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-5">
                            <label for="image" class="text-small text-white">Image</label>
                            <input id="image" type="file" class="text-black text-black w-full
                             @error('image') border-2 border-red-600 @enderror" name="image">

                            @error('image')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>

                        <select
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight
                            focus:outline-none focus:bg-white focus:border-gray-500 @error('lang') border-2 border-red-600 @enderror"
                            id="lang" name="lang">
                                <option value="shqip" {{ $course->lang == "shqip" ? "selected" : "" }}>Shqip</option>
                                <option value="македонски" {{ $course->lang == "македонски" ? "selected" : "" }}>Македонски</option>
                        </select>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-4">
                                    <button type="submit"
                                class="mt-4 transition duration-200 ease-in-out bg-orange-500 font-bold text-white py-6 px-10 rounded hover:bg-gray-200 hover:text-gray-600">
                                {{ __('Save') }}
                                    </button>
                                </div>
                                <div class="col-auto text-right">
                                    <a href="{{ url()->previous() }}">
                                    <div
                                        class="mt-8 transition duration-200 ease-in-out bg-white font-bold text-orange-500 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                                        {{ __('Cancel') }}
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
