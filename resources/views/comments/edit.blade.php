@extends('layouts.app')

@section('content')
<div class="container my-10">
    <div class="row justify-center">
        <div class="col-10">
            <div class="bg-blue-500 border rounded mb-10 lg:mb-0">
                <div class="m-10">
                    <h2 class="text-4xl font-bold text-white">Edit Comment</h2>

                    <form action="/comments/{{$comment->id}}" enctype="multipart/form-data" method="post">

                        @csrf
                        @method('PATCH')

                        <div class="col-md-6 mb-5">
                            <label for="body" class="text-small text-white">Body</label>
                            <input id="body" type="text" class="rounded bg-gray-100 py-6 pl-2 text-black w-full
                            @error('body') border-2 border-red-600 @enderror" name="body"
                                value="{{ old('body') ?? $comment->body }}" required autofocus>

                            @error('body')
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
