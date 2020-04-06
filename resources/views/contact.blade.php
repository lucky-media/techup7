@extends('layouts.app')

@section('content')
<div style="background:url('/storage/title_img.png'); ">
    <div class="container">
        <div class="row items-center justify-between py-20">
            <div class="col-4">
                <h2 class="text-4xl"> Contact </h2>
            </div>
        </div>
    </div>
</div>
<div class="container my-20">
    <div class="row justify-center text-center">
        <div class="col-10">

            We are ready to help you out on the different issues you might have with the platform. Please feel free to
            contact us. We would appreciate if you could give us feedback on the platform.

        </div>
    </div>
</div>
<div class="container mt-40">
    <div class="row">
        <div class="lg:col-6">
            <h2 class="font-bold text-4xl">Send us a Message</h2>
        </div>
    </div>
</div>

@if ( session('success'))
    <div class="container my-4">
        <div class="row">
            <div class="lg:col-6">
                <h2 class="font-bold">{{ session('success') }}</h2>
            </div>
        </div>
    </div>
@endif 

<form action="/send/email" enctype="multipart/form-data" method="get">
    {{ csrf_field() }}

    <div class="container mt-5">
        <div class="row">
            <div class="lg:col-6">
                <input class="mt-5 bg-gray-100 py-6 pl-10 w-full @error('fname') border-2 border-red-600 @enderror"
                type="text" placeholder="First Name" id="fname" name="fname" value="{{ old('fname') }}" required autofocus />
                
                @error('fname')
                <span role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
                @enderror
            </div>

            <div class="lg:col-6">
                <input class="mt-5 bg-gray-100 py-6 pl-10 w-full @error('fname') border-2 border-red-600 @enderror"
                type="text" placeholder="Last Name" id="lname" name="lname" value="{{ old('lname') }}" required />
                
                @error('lname')
                <span role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
                @enderror
            </div>

            <div class="lg:col-6">
                <input class="mt-5 bg-gray-100 py-6 pl-10 w-full @error('fname') border-2 border-red-600 @enderror"
                type="text" placeholder="Email Adress" id="email" name="email" value="{{ old('email') }}" required />

                @error('email')
                <span role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
                @enderror
            </div>

            <div class="lg:col-6">
                <input class="mt-5 bg-gray-100 py-6 pl-10 w-full @error('fname') border-2 border-red-600 @enderror"
                type="text" placeholder="Subject" id="subject" name="subject" value="{{ old('subject') }}" required />

                @error('subject')
                <span role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
                @enderror
            </div>

            <div class="col-12">
                <textarea class="bg-gray-100 py-6 pl-10 w-full @error('fname') border-2 border-red-600 @enderror mt-5"
                id="message" name="message" rows="5" value="{{ old('message') }}"
                    placeholder="Message" required></textarea>

                @error('message')
                <span role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
                @enderror

                <button class="my-6 bg-blue-500 text-white text-center w-full py-5">
                    Send
                </button>
                
            </div>
        </div>
    </div>
</form>

<div class="container mt-24">
    <div class="row">
        <div class="col-12">
            <h2 class="font-bold text-4xl ">Frequently Asked Question</h2>
            <p>Some of the most frequently asked questions. If the asnwers below do not satisfy your curiosity, please
                feel free to contact us with the form above.
            </p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="w-ful h-auto lg:col-6 my-8">
            <img src="/storage/contact_img.png" alt="Contact_img">
        </div>
    </div>
</div>
<div class="container">
    <div class="row text-center">
        <div class="lg:col-4 text-justify">
            <h2 class="font-bold text-lg">Are the courses really free?</h2>
            <p>Yes the courses are completely free of charge.
                All you have to do is work for it!
            </p>
        </div>
        <div class="lg:col-4 text-justify">
            <h2 class="mt-5 lg:mt-0 font-bold text-lg">Where do the materials come from?</h2>
            <p>The materials do not come from a single source, but rather from the experience and knowledge of many
                different experts.
            </p>
        </div>
        <div class="lg:col-4 text-justify">
            <h2 class="mt-5 lg:mt-0 font-bold text-lg">Are there any age requirements?</h2>
            <p>The courses will mostly be aimed at high school students, but they are not limited to only them. Anyone
                with an interest in programming is free to check them out.
            </p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row text-center mt-5 mb-10 lg:mt-10 lg:mb-24">
        <div class="lg:col-4 text-justify">
            <h2 class="mt-5 lg:mt-0 font-bold text-lg">Are there any offline courses?</h2>
            <p>
                Yes, TechUP started as a small web developing course and with time it slowly grew to be what it is
                today. So except the online courses, TechUP will continue to function as it has. Before the offline
                course starts there will be applications available in this page.

            </p>
        </div>
        <div class="lg:col-4 text-justify">
            <h2 class="mt-5 lg:mt-0 font-bold text-lg"> Are there any previous knowledge requirements? </h2>
            <p>
                No there are not any previous knowledge requirements. There are more high level courses, but most of
                them are designed to teach you what you need to know from scratch.

            </p>
        </div>
        <div class="lg:col-4 text-justify">
            <h2 class="mt-5 lg:mt-0 font-bold text-lg">Can these courses considered as a substitute for school?</h2>
            <p>
                To some exten
                t yes but not fully. If you are a high schools tudent, these courses can help you get
                started and we greatly encourage you to continue your studies to university.

            </p>
        </div>
    </div>
</div>
@endsection
