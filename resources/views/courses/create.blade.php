@extends('layouts.app')

@include('partials.tiny')

@section('content')
<div class="container my-10">
    <div class="row justify-center">
        <div class="col-10">
            <div class="bg-blue-500 border rounded mb-10 lg:mb-0">
                <div class="m-10">
                    <h2 class="text-4xl font-bold text-white">Add New Course</h2>

                    <form action="{{ route('courses.store') }}" enctype="multipart/form-data" method="post">

                        @csrf

                        <div class="col-md-6 mb-5">
                            <label for="title" class="text-small text-white">Title</label>
                            <input id="title" type="text" class="rounded bg-gray-100 py-6 pl-2 text-black w-full
                            @error('title') border-2 border-red-600 @enderror" name="title"
                                value="{{ old('title') }}" required autofocus>

                            @error('title')
                            <span role="alert">
                                <strong>{{ $message }}</strong><br>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-5">
                            <label for="body" class="text-small text-white">Body</label>
                            <input id="body" class="w-full form-control" name="body" value="{{ old('body') }}">

                            @error('body')
                            <span role="alert">
                                <strong>{{ $message }}</strong><br>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-5">
                            <label for="image" class="text-small text-white">Image</label>
                            <input id="image" type="file" class="rounded text-black w-full
                            @error('image') border-2 border-red-600 @enderror" name="image"
                                value="{{ old('image') }}" required>

                            @error('image')
                            <span role="alert">
                                <strong>{{ $message }}</strong><br>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-5">
                            <label for="lang" class="text-small text-white">Language</label>
                            <select
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight
                            focus:outline-none focus:bg-white focus:border-gray-500 @error('lang') border-2 border-red-600 @enderror"
                            id="lang" name="lang">
                                <option value="shqip">Shqip</option>
                                <option value="македонски">Македонски</option>
                            </select>

                            @error('lang')
                            <span role="alert">
                                <strong>{{ $message }}</strong><br>
                            </span>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-5">
                            <label for="category" class="text-small text-white">Category</label>
                            <select
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight
                            focus:outline-none focus:bg-white focus:border-gray-500 @error('category') border-2 border-red-600 @enderror"
                            id="category" name="category">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                            @error('category')
                            <span role="alert">
                                <strong>{{ $message }}</strong><br>
                            </span>
                            @enderror
                        </div>

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
