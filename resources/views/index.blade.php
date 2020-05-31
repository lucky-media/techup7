@extends('layouts.app')

@section('content')
<div class="bg-blue-500">
    <div class="container">
        <div class="row items-center">
            <div class="lg:col-6">
                <h1 class="text-3xl lg:text-6xl font-bold text-white text-center pb-8 lg:pb-0 lg:text-left lg:offset-1">
                    {{ __('index.learn_to_code') }}
                </h1>
            </div>

            <div class="lg:col-6 order-first lg:order-none">
                <img class="w-full h-auto py-8" src="{{ asset('/storage/home_intro.png') }}" alt="home_intro">
            </div>
        </div>
    </div>
</div>
<div class="container mt-16">
    <div class="row justify-center text-center">
        <div class="lg:col-7">
            <h2 class="text-3xl lg:text-5xl font-bold ">{{ __('index.a_ton_of_courses') }}</h2>
            <p class="text-center">{{ __('index.from_graphic_design') }}
                <br>{{ __('index.you_will_learn') }}</p>
                <form action="{{ route('courses.index') }}" enctype="multipart/form-data" method="get">
                    <button type="submit"
                    class="mt-6 bg-blue-500 text-white px-5 py-2 rounded transition duration-200 ease-in-out hover:bg-gray-600">
                    {{ __('general.view_all_courses') }}</button>
                </form>
        </div>
    </div>
</div>

@include('partials.all_courses')

<div style="background:url('/storage/home_register.png') no-repeat center center / cover;">
    <div class="container">
        <div class="row py-32 items-center">
            <div class="lg:col-7">
                <h1 class="text-white text-3xl lg:text-5xl font-bold">{{ __('index.dont_forget_to_register') }}</h1>
                <form action="{{ route('register') }}" enctype="multipart/form-data" method="get">
                    <button type="submit"
                    class="transition duration-200 ease-in text-white py-2 px-5 border border-white rounded hover:bg-white hover:text-indigo-900">
                    {{ __('general.register') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div style="background:url(/storage/techup_bg.png);">
    <div class="container">
        <div class="row justify-center text-center py-48">
            <div class="lg:col-7">
                <h3 class="text-2xl font-bold">{{ __('index.techup_courses') }}</h3>
                <p class="my-6">{{ __('index.techup_is_a_free') }}</p>
                <p>{{ __('index.enhance_your_skills') }}</p>
                <form action="{{ route('courses.index') }}" enctype="multipart/form-data" method="get">
                    <button type="submit"
                    class="mt-6 bg-blue-500 text-white px-5 py-2 rounded transition duration-200 ease-in-out hover:bg-gray-600">
                    {{ __('general.view_all_courses') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="bg-orange-500">
    <div class="container">
        <div class="row items-center py-8">
            <div class="lg:col-5 lg:offset-1">
                <img src="{{ asset('/storage/brain.png') }}" alt="brain">
                <h2 class="mt-8 font-bold text-2xl text-base">{{ __('index.learn_by_doing') }}</h2>

                <p class="mt-5">{{ __('index.learn_by_theory') }}<br>
                    {{ __('index.grasp_the_information') }}
                </p>
            </div>
            <div class="lg:col-6 mt-8 lg:mt-0">
                <img class="w-full h-auto" src="{{ asset('/storage/home_learn.png') }}" alt="">
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row items-center py-48">
        <div class="lg:col-6 overflow-hidden">
            <div style="height: 286px;" class="relative blue-shadow">
                <iframe class="absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/FWdYL1R4rec"
                    frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
        </div>
        <div class="lg:col-5 lg:offset-1 text-justify mt-12 lg:mt-0">
            <h3 class="text-3xl font-bold">{{ __('index.mission') }}</h3>
            <p class="my-5">{{ __('index.the_youth_empowerment') }}
            </p>
            <p>
                {{ __('index.yep_is_achieving') }}<br>
                {{ __('index.hashtags') }}                
            </p>
        </div>
    </div>
</div>

@endsection