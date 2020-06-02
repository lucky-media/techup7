@foreach($comments as $comment)

<div class="container my-10 ml-10">
    <div class="row no-gutters">
        <div class="px-0">
            {{-- Display profile image for instructors, or display no_image for students --}}
            <img src="{{ $comment->user->profile()->exists() ? asset($comment->user->profile->profileImage()) : asset('/storage/no_image.jpg') }}"
                 alt="profile image" class="rounded-full w-12 h-12">
        </div>
        <div class="col-10">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-auto" style="max-width: 60%;">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('profiles.index', $comment->user->id) }}">
                                        <span class="font-bold underline"> {{ $comment->user->name }} </span> &nbsp;
                                        <span class="text-xs"> ({{ $comment->created_at->diffForHumans() }})</span>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-justify">
                                    {{ $comment->body }}
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-2">      
                                            @can('update', $comment)
                                                <form action="{{ route('comments.edit', $comment) }}" enctype="multipart/form-data" method="get">
                                                    <button type="submit" class="bg-transparent hover:bg-blue-500 text-gray-600 text-xs hover:text-white rounded">
                                                        {{ __('general.edit') }}</button>
                                                </form>
                                            @endcan
                                        </div>
                                        <div class="col-2">
                                            @can('delete', $comment)
                                                <form action="{{ route('comments.destroy', $comment) }}" enctype="multipart/form-data" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="bg-transparent hover:bg-blue-500 text-gray-600 text-xs hover:text-white rounded"
                                                    onclick="return confirm('{{ __('general.are_you_sure') }}')">
                                                    {{ __('general.delete') }}</button>
                                                </form>
                                            @endcan
                                        </div>
                                        {{-- Comments can be flagged as inappropriate by students or instructors. Admin manages flagged comments. --}}
                                        <div class="col-2">
                                            @can('flagInappropriate', $comment)
                                                <form action="{{ route('comments.flag', $comment) }}" enctype="multipart/form-data" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PATCH') }}
                                                    <input id="approved" type="text" name="approved" value="false" hidden>
                                                    <button type="submit" class="bg-transparent hover:bg-blue-500 text-orange-500 text-xs hover:text-white rounded">
                                                        {{ __('general.inappropriate') }}</button>
                                                </form>
                                            @endcan
                                            @can('flagged', $comment)
                                                <p class="text-gray-500 text-xs underline">
                                                    {{ __('general.flagged') }}
                                                </p>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Add a reply. We send the lesson_id and comment_id as hidden, because the CommentController needs them. --}}
                    <div class="col">
                        <form action="{{ route('comments.reply') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="col-auto">
                                        <input id="lesson_id" type="text" name="lesson_id" value="{{ $lesson->id }}"
                                            hidden>
                                        <input id="comment_id" type="text" name="comment_id" value="{{ $comment->id }}"
                                            hidden>

                                        <textarea id="body" type="text"
                                            class="rounded bg-gray-100 w-46 py-2 px-2 @error('body') is-invalid @enderror"
                                            name="body"></textarea>

                                        @error('body')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="bg-transparent hover:bg-blue-500 text-gray-600 text-xs hover:text-white py-2 px-2
                                        border border-orange-500 hover:border-transparent rounded">
                                        {{ __('general.reply') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- By calling this view again, we can add a new reply. --}}
    <div class="row">
        <div class="col-12">
            @include('partials.comment_replies', ['comments' => $comment->replies])
        </div>
    </div>
</div>
@endforeach