@extends('layouts.app')

@section('content')

<div style="background:url('/storage/title_img.png'); ">
    <div class="container">
        <div class="row items-center justify-between py-20">
            <div class="col-4">
                <h2 class="text-4xl">Dashboard</h2>
            </div>
        </div>
    </div>
</div>

<div class="container my-4">
    <div class="row">
        <div class="col-8">
                <h2 class="text-3xl">Instructors</h2>
        </div>
        <div class="col-3">
            <div class="row">
                <div class="col-6 px-4">  
                    <form action="/comments" enctype="multipart/form-data" method="get">
                            <button type="submit" 
                            class="transition duration-200 ease-in-out bg-orange-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                            {{ __('Comments') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container my-10">
    <div class="row justify-center">
        @foreach($instructors as $instructor)
            <div class="col-6 my-4">
                <a href="/profile/{{ $instructor->id }}">
                    <div class="flex flex-row items-center mb-4">
                        <img class="w-24 h-24 rounded-full border-2 border-orange-500" src="{{ $instructor->profile->profileImage() }}" alt="webdevelopment">
                        <div class="ml-4">
                            <h2 class="text-2xl font-bold">{{ $instructor->name }}</h2>
                            <p>{{ $instructor->role }}</p>
                            <div class="row">
                                <div class="col-6">  
                                    <form action="/admin/{{ $instructor->id }}/edit" enctype="multipart/form-data" method="get">
                                            <button type="submit" 
                                            class="transition duration-200 ease-in-out bg-orange-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                                            {{ __('Edit') }}</button>
                                    </form>
                                </div>
                
                                <div class="col-6 px-2">
                                    <form action="/admin/{{ $instructor->id }}" enctype="multipart/form-data" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" onclick="return confirm('Are you sure?')"
                                            class="transition duration-200 ease-in-out bg-blue-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                                            {{ __('Delete') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

<div class="row">
    <div class="col-12 d-flex justify-content-center">
        {{ $instructors->links() }}
    </div>
</div>

<div class="container my-4">
    <div class="row">
        <div class="col-8">
                <h2 class="text-3xl">Students</h2>
        </div>
    </div>
</div>

<div class="container my-10">
    <div class="row justify-center">
        @foreach($students as $student)
            <div class="col-6 my-4">
                <a href="/profile/{{ $student->id }}">
                    <div class="flex flex-row items-center mb-4">
                        <img class="w-24 h-24 rounded-full border-2 border-orange-500" src="{{ $student->profile->profileImage() }}" alt="webdevelopment">
                        <div class="ml-4">
                            <h2 class="text-2xl font-bold">{{ $student->name }}</h2>
                            <p>{{ $student->role }}</p>
                            <div class="row">
                                <div class="col-6">  
                                    <form action="/admin/{{ $student->id }}/edit" enctype="multipart/form-data" method="get">
                                            <button type="submit" 
                                            class="transition duration-200 ease-in-out bg-orange-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                                            {{ __('Edit') }}</button>
                                    </form>
                                </div>
                
                                <div class="col-6 px-2">
                                    <form action="/admin/{{ $student->id }}" enctype="multipart/form-data" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" onclick="return confirm('Are you sure?')"
                                            class="transition duration-200 ease-in-out bg-blue-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                                            {{ __('Delete') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

<div class="row">
    <div class="col-12 d-flex justify-content-center">
        {{ $students->links() }}
    </div>
</div>

@endsection
