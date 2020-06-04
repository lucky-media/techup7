@extends('layouts.app')

@section('content')

<div style="background:url({{ asset('/storage/title_img.png') }}); ">
    <div class="container">
        <div class="row items-center justify-between py-20">
            <div class="col-4">
                <a href="{{ route('admin.index') }}">
                    <h2 class="text-4xl">Dashboard</h2>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Tthe admin manages comments that are flagged as inappropriate. He can delete or approve them --}}
<div class="container my-4">
    <div class="row">
        <div class="col-8">
                <h2 class="text-3xl">These comments need approval:</h2>
        </div>
    </div>
</div>

<div class="container my-10">
        @forelse($comments as $comment)
            <div class="row py-4 border-b-2 border-gray-300">
                <div class="col-6">
                    {{-- We check if the comment belongs to a lesson or course --}}
                    @if (class_basename(get_class($comment->commentable)) == 'Lesson')
                        <a href="{{ route('lessons.show', $comment->commentable->slug) }}">
                    @elseif (class_basename(get_class($comment->commentable)) == 'Course')
                        <a href="{{ route('courses.show', $comment->commentable->slug) }}">  
                    @endif
                            <p><strong>Commented on:</strong>{{ $comment->commentable->title }}</p>
                            <p><strong>Comment:</strong> {{ $comment->body }}</p>
                        </a>
                        
                        {{-- Link to user profile --}}
                        <a href="{{ route('profiles.show', $comment->user->id) }}">
                            <p><strong>Commented by:</strong> {{ $comment->user->name }}</p>
                        </a>
                </div>
                    <div class="col-2">  
                        <form action="{{ route('comments.approved', $comment) }}" shenctype="multipart/form-data" method="post">
                            {{ csrf_field() }}                                            
                            {{ method_field('PUT') }}
                                <button type="submit" onclick="return confirm('Are you sure?')" 
                                class="transition duration-200 ease-in-out bg-orange-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                                {{ __('Approve') }}</button>
                        </form>
                    </div>
    
                    <div class="col-2 px-2">
                        <form action="{{ route('comments.destroy', $comment) }}" enctype="multipart/form-data" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" onclick="return confirm('Are you sure?')"
                                class="transition duration-200 ease-in-out bg-blue-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                                {{ __('Delete') }}</button>
                        </form>
                    </div>
            </div>
        @empty
            <div>
                No comments to display
            </div>
    @endforelse
</div>

@endsection