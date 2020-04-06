@extends('layouts.app')

@section('content')

<div style="background:url('/storage/title_img.png');">
    <div class="container">
        <div class="row items-center justify-between py-20">
            <div class="col-4">
                <h2 class="text-4xl"> Meet our Instructors </h2>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row text-center my-20">
        @foreach($users as $user)
        <div class="lg:col-4 my-10">
            <a class="hover:text-orange-500" href="/profile/{{ $user->id }}">
                <img class="rounded-full h-64 w-64 border-2 border-orange-500" src="{{ $user->profile->profileImage() }}" alt="profile image">
                <h2 class="font-semibold text-2xl transition duration-200 ease-in">{{ $user->name }}</h2>
            </a>
        </div>
        @endforeach
    </div>
</div>

<div class="row">
    <div class="col-12 d-flex justify-content-center">
        {{ $users->links() }}
    </div>
</div>
@endsection
