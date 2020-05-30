@extends('layouts.app')

@section('content')

<div style="background:url({{ asset('/storage/title_img.png') }});">
    <div class="container">
        <div class="row items-center justify-between py-20">
            <div class="col-4">
                <h2 class="text-4xl">{{ __('general.search_instructors') }}</h2>
            </div>
            <div class="col-6">
                <form action="{{ route('search.instructors') }}" method="POST">
                    {{ csrf_field() }}
                    
                    <input id="searchTerm" type="text" name="searchTerm" class="rounded bg-gray-100 border-2 border-orange-500 py-2 pl-2 text-black w-4/12" required>
                    <button type="submit" 
                        class="transition duration-200 ease-in-out font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                        {{ __('general.search') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- List all instructor names with the search term that the user provided --}}
<div class="container my-20">
    <div class="row text-center">
        @forelse($users as $user)
        <div class="lg:col-4 my-10">
            <a class="hover:text-orange-500" href="{{ route('profiles.show', $user->id) }}">
                <img class="rounded-full h-64 w-64 border-2 border-orange-500" src="{{ asset($user->profile->profileImage()) }}" alt="profile image">
                <h2 class="font-semibold text-2xl transition duration-200 ease-in">{{ Str::limit($user->name, 25) }}</h2>
            </a>
        </div>
        @empty
        <div>
            {{ __('general.there_is_no_instructor') }}
        </div>
    @endforelse
    </div>
    <div class="row justify-center mt-4">
        <div class="col-6 justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
