@extends('layouts.app')

@section('content')

<div style="background:url({{ asset('/storage/title_img.png') }});">
    <div class="container">
        <div class="row items-center justify-between py-20">
            <div class="col-4">
                <h2 class="text-4xl"> Meet our Instructors </h2>
            </div>
        </div>
    </div>
</div>

<div class="container my-20">
    <div class="row text-center">
        @foreach($users as $user)
        <div class="lg:col-4 my-10">
            <a class="hover:text-orange-500" href="{{ route('profiles.show', $user->id) }}">
                <img class="rounded-full h-64 w-64 border-2 border-orange-500" src="{{ asset($user->profile->profileImage()) }}" alt="profile image">
                <h2 class="font-semibold text-2xl transition duration-200 ease-in">{{ Str::limit($user->name, 25) }}</h2>
            </a>
        </div>
        @endforeach
    </div>
    <div class="row justify-center mt-4">
        <div class="col-6 justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
