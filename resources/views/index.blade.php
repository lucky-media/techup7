@extends('layouts.app')

@section('content')
<div class="bg-blue-500">
    <div class="container">
        <div class="row items-center">
            <div class="lg:col-6">
                <h1 class="text-3xl lg:text-6xl font-bold text-white text-center pb-8 lg:pb-0 lg:text-left lg:offset-1">
                    Learn to code for free!
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
            <h2 class="text-3xl lg:text-5xl font-bold ">A ton of Courses</h2>
            <p class="text-center">From graphic design to web development, it’s all here!
                <br>You will learn how to code front end websites with HTML, Javascript & CSS, as well as the back end
                of websites with PHP & .NET </p>
                <form action="{{ route('courses.index') }}" enctype="multipart/form-data" method="get">
                    <button type="submit"
                    class="mt-6 bg-blue-500 text-white px-5 py-2 rounded transition duration-200 ease-in-out hover:bg-gray-600">
                    {{ __('View All Courses') }}</button>
                </form>
        </div>
    </div>
</div>

@include('partials.all_courses')

<div style="background:url('/storage/home_register.png') no-repeat center center / cover;">
    <div class="container">
        <div class="row py-32 items-center">
            <div class="lg:col-7">
                <h1 class="text-white text-3xl lg:text-5xl font-bold">Don't forget to register</h1>
                <form action="{{ route('register') }}" enctype="multipart/form-data" method="get">
                    <button type="submit"
                    class="transition duration-200 ease-in text-white py-2 px-5 border border-white rounded hover:bg-white hover:text-indigo-900">
                    {{ __('Register') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div style="background:url(/storage/techup_bg.png);">
    <div class="container">
        <div class="row justify-center text-center py-48">
            <div class="lg:col-7">
                <h3 class="text-2xl font-bold">TechUp Courses</h3>
                <p class="my-6">TechUP is a FREE computer programming platform, open to high school students. No
                    previous experience
                    is required; our platform is designed for beginners and will teach you to design a website in HTML,
                    CSS, Javascript, Jquery, Bootstrap, WordPress and much more! Materials will be taught in Albanian
                    and Macedonian.
                </p>
                <p>Enhance your skills in your field of choice</p>
                <form action="{{ route('courses.index') }}" enctype="multipart/form-data" method="get">
                    <button type="submit"
                    class="mt-6 bg-blue-500 text-white px-5 py-2 rounded transition duration-200 ease-in-out hover:bg-gray-600">
                    {{ __('View All Courses') }}</button>
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
                <h2 class="mt-8 font-bold text-2xl text-base">Learn by Doing</h2>

                <p class="mt-5">Learn by theory and with IRL projects!<br>
                    Grasp the information very quickly with our well thought out classes with step by step programs!
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
            <h3 class="text-3xl font-bold">Mission</h3>
            <p class="my-5">The Youth Empowerment Platform strives to support Gostivar’s youth by fostering their
                leadership skills,
                encouraging their civic engagement, providing technical skills, and ensuring all members have a space to
                full their potential in becoming their most authentic, best version of themselves.
            </p>
            <p>
                YEP is achieving its goal by implementing various projects for the youth, such as: <br>
                #techathon, #gostronic, #mycitymypride, #ihaveadream, #yeptalks and many more!.
            </p>
        </div>
    </div>
</div>

@endsection