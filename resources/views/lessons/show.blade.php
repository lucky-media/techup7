@extends('layouts.app')

@section('content')

<div style="background:url({{ asset('/storage/title_img.png') }}); ">
    <div class="container">
        <div class="row items-center justify-between py-20">
            <div class="col-12">
                <h2 class="text-4xl">{{ $lesson->title }} </h2>
            </div>
        </div>
    </div>
</div>      

{{-- The owner can edit or delete the lesson --}}
<div class="container my-4">
    <div class="row">
        <div class="col-8">
            <div class="text-sm">
                {{ __('general.by') }} <a href="{{ route('profiles.index', $lesson->course->user->id) }}" class="text-blue-500">{{ $lesson->course->user->name }}</a>
                , {{ __('general.last_update_on') }} {{ $lesson->updated_at->format('M Y') }}
            </div>
        </div>
        <div class="col-3">
            <div class="row">
                <div class="col-6 px-4">
                @can('update', $lesson)    
                    <form action="{{ route('lessons.edit', $lesson) }}" enctype="multipart/form-data" method="get">
                            <button type="submit" 
                            class="transition duration-200 ease-in-out bg-orange-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                            {{ __('general.edit') }}</button>
                    </form>
                @endcan
                </div>

                <div class="col-6 px-4">
                @can('delete', $lesson)
                    <form action="{{ route('lessons.destroy', $lesson) }}" enctype="multipart/form-data" method="post">
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

{{-- We display the lesson body on the left and a list of all sibling lessons on the right --}}
<div class="container my-20">
    <div class="row">
        <div class="col-7 text-justify">
            <p>
                {!! $lesson->body !!}
            </p>
        </div>
        
        <div class="col-5 mb-10">
            <a href="{{ route('courses.show', $lesson->course->slug) }}">
                <h2 class="text-white font-bold text-2xl bg-blue-500 px-8 py-5">{{ $lesson->course->title }}</h2>
            </a>
            
            @foreach ($lesson->course->lesson->reverse() as $lessons)
                @if ($lessons->id == $lesson->id)
                        <h2 class="text-white bg-gray-600 px-8 py-5 border-b-2 border-white">{{ $lessons->title }}</h2>  
                @else
                    <a href="{{ route('lessons.show', $lessons) }}">
                        <h2 class="text-black bg-gray-100 px-8 py-5 border-b-2 border-white">{{ $lessons->title }}</h2>    
                    </a>
                @endif
            @endforeach

            <br>
            @can('delete', $lesson)
            <div>
                <form action="{{ route('lessons.create', $lesson->course->slug) }}" enctype="multipart/form-data" method="get">
                    <button type="submit"
                    class="transition duration-200 ease-in-out bg-blue-500 font-bold text-white py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                    {{ __('general.add_new_lesson') }}</button>
                </form>
            </div>
        @endcan
        </div>
    </div>
</div>


{{-- Comments section. We can see total comments count and add a new comment --}}

<div class="container mt-10">
    <div class="row">
        <div class="col-12">
            <h2 class="text-black py-5 border-b-2 border-white">{{ __('general.comments') }} ({{ $lesson->commentsCount() }})</h2>
        </div>
    </div>
</div>

<form action="{{ route('comments.store') }}" enctype="multipart/form-data" method="post">
    @csrf
<div class="container">
    <div class="row">
      <div class="col-8">           
                <input id="lesson_id" type="text" name="lesson_id" value="{{ $lesson->id }}" hidden>

                <textarea id="body" type="text" class="rounded bg-gray-100 w-full py-2 px-2 @error('body') is-invalid @enderror"
                name="body"></textarea>

                @error('body')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
      </div>
      <div class="col-4">
        <button type="submit"
        class="transition duration-200 ease-in-out bg-blue-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
        {{ __('general.add_new_comment') }}</button>
      </div>
    </div>
  </div>
</form>


{{-- Show comments, replies and add new replies from another view. --}}

<div class="container my-10">
    <div class="row">
        @include('partials._comment_replies', ['comments' => $lesson->comments, 'lesson_id' => $lesson->id])
    </div>
</div>

@endsection