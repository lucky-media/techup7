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

<div class="container my-4">
    <div class="row">
        <div class="col-8">
                <h2 class="text-3xl">All categories:</h2>
        </div>
        <div class="col-3">
            <div>
                <form action="{{ route('categories.create') }}" enctype="multipart/form-data" method="get">
                    <button type="submit"
                    class="transition duration-200 ease-in-out bg-blue-500 font-bold text-white py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                    {{ __('Create New Category') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Display all categories, edit or delete --}}
<div class="container my-10">
    <div class="row">
        <div class="col-6">
            @forelse($categories as $category)
                <div class="row py-4 border-b-2 border-gray-300">
                    <div class="col-6">
                        <p>{{ $category->name }}</p>
                    </div>

                    <div class="col-2">  
                        <form action="{{ route('categories.edit', $category) }}" shenctype="multipart/form-data" method="get">
                                <button type="submit" 
                                class="transition duration-200 ease-in-out bg-orange-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                                {{ __('Edit') }}</button>
                        </form>
                    </div>
                        
                    <div class="col-2">
                        <form action="{{ route('categories.destroy', $category) }}" enctype="multipart/form-data" method="post">
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
                    No categories to display
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection