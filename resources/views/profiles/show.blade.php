@extends('layouts.app')

@section('content')

<div style="background:url({{ asset('/storage/title_img.png') }}); ">
    <div class="container">
        <div class="row items-center justify-between py-20">
            <div class="col-4">
                <h2 class="text-4xl">{{ __('general.profile') }}</h2>
            </div>
        </div>
    </div>
</div>

{{-- Details about the instructor --}}
<div class="container my-20">
    <div class="row items-center">
        <div class="col-4">
            <img src="{{ asset($user->profile->profileImage()) ?? asset('/svg/techup.svg') }}" class="rounded-lg">
        </div>
        <div class="col-6">
            <h2 class="font-semibold text-2xl text-orange-500 py-2">{{ $user->name }}</h2>
            <p class="py-1 text-justify"><strong>{{ __('general.bio') }}:</strong> {{ $user->profile->bio ?? '' }}</p>
            <p class="py-1"><strong>{{ __('general.email') }}:</strong> {{ $user->email }}</p>
            <p class="py-1"><strong>{{ __('general.role') }}:</strong> {{ $user->role }}</p>
            <p class="py-1"><strong>{{ __('general.courses') }}:</strong> {{ $user->courses->count() }}</p>
            @can('update', $user->profile)
                <form action="{{ route('profiles.edit', $user) }}" enctype="multipart/form-data" method="get">
                        <button type="submit"
                        class="transition duration-200 ease-in-out bg-orange-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                        {{ __('general.edit_profile') }}</button>
                </form>
            @endcan
        </div>
    </div>
</div>

{{-- The instructor views a button for adding new courses --}}
<div class="container my-10">
    <div class="row">
        @can('create', $user->profile)
        <div class="col-3">
            <div class="my-10">

                    <form action="{{ route('courses.create') }}" enctype="multipart/form-data" method="get">
                            <button type="submit"
                            class="transition duration-200 ease-in-out bg-blue-500 font-bold text-white py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                            {{ __('general.add_new_course') }}</button>
                    </form>

            </div>
        </div>
        @endcan
    </div>

    @livewire('search-courses-by-instructor', ['user' => $user])

</div>

@endsection