@extends('layouts.app')

@section('content')

<div style="background:url({{ asset('/storage/title_img.png') }}); ">
    <div class="container">
        <div class="row items-center justify-between py-20">
            <div class="col-6">
                <h2 class="text-4xl"> {{ $course->title }} </h2>
            </div>
        </div>
    </div>
</div>

{{-- The owner of the course can edit or delete course--}}
<div class="container my-4">
    <div class="row">
        <div class="col-8">
            <div class="text-sm">
                {{ __('general.by') }} <a href="{{ route('profiles.show', $course->user->id) }}" class="text-blue-500">{{ $course->user->name }}</a>
                , {{ __('general.last_update_on') }} {{ $course->updated_at->format('M Y') }}
            </div>
        </div>
        <div class="col-3">
            <div class="row">
                <div class="col-6 px-4">
                    @can('update', $course)
                    <form action="{{ route('courses.edit', $course) }}" enctype="multipart/form-data" method="get">
                            <button type="submit"
                            class="transition duration-200 ease-in-out bg-orange-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                            {{ __('general.edit') }}</button>
                    </form>
                    @endcan
                </div>

                <div class="col-6 px-4">
                    @can('delete', $course)
                    <form action="{{ route('courses.destroy', $course) }}" enctype="multipart/form-data" method="post">
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

<livewire:search-lessons :course="$course" :lessons="$lessons">

{{-- Comments section. We can see total comments count and add a new comment --}}
<div class="container mt-10">
    <div class="row">
        <div class="col-12">
            <h2 class="text-black py-5 border-b-2 border-white">{{ __('general.comments') }} ({{ $course->commentsCount() }})</h2>
        </div>
    </div>
</div>

<livewire:add-comment :commentable="$course">

@endsection
