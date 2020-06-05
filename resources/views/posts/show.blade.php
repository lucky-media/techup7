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

{{-- Display Post --}}
<livewire:display-post :post="$post">

{{-- Answer section --}}
<livewire:add-answer :post="$post">

@endsection
