@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/comments/{{$comment->id}}" enctype="multipart/form-data" method="post">
 
     @csrf
     @method('PATCH')

     <div class="row">
            <div class="col-8 offset-2">
            <div class="row">
                <h3>Edit Comment</h3>
            </div>

        <div class="form-group row">
                    <input id="lesson_id"
                        type="text"
                        name="lesson_id"
                        value="{{ old('lesson_id') ?? $comment->lesson->id }}" hidden>
        </div>

        <div class="form-group row">
                    <label for="body" class="col-md-4 col-form-label">Body</label>
                    
                    <input id="body"
                    type="text"
                    class="form-control @error('body') is-invalid @enderror"
                    name="body"
                    value="{{ old('body') ?? $comment->body }}"
                    autocomplete="body">

                        @error('body')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">
                        Save Changes
                    </button>
                </div>
             </div>
        </div>
    </form>
</div>
@endsection
