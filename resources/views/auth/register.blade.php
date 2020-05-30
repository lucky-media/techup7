@extends('layouts.app')

@section('content')

<div class="container my-20">
    <div class="row justify-center">
        <div class="lg:col-6">
            <div class="bg-blue-500 border rounded mb-10 lg:mb-0">
                
                <div class="m-10">
                    <h2 class="text-4xl font-bold mb-4">{{ __('general.register') }}</h2>
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                    {{-- NAME --}}
                    <div class="col-md-6">
                    <label for="name" class="text-small text-white">{{ __('general.name') }}</label>
                    <input id="name" type="text" class="rounded bg-gray-100 mb-5 py-6 pl-2 text-black w-full form-control @error('name') border-2 border-red-600 @enderror" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                        <span role="alert">
                            <strong>{{ $message }}</strong><br>
                        </span>
                        @enderror
                    </div>                    
                    
                    {{-- Username --}}
                    <div class="col-md-6">
                        <label for="username" class="text-small text-white">{{ __('general.username') }}</label>
                        <input id="username" type="text" class="rounded bg-gray-100 mb-5 py-6 pl-2 text-black w-full form-control @error('username') border-2 border-red-600 @enderror" name="username" value="{{ old('username') }}" required>
                        @error('username')
                        <span role="alert">
                            <strong>{{ $message }}</strong><br>
                        </span>
                        @enderror
                    </div>
                    
                    {{-- Email --}}
                    <div class="col-md-6">
                    <label for="email" class="text-small text-white">{{ __('general.email') }}</label>
                    <input id="email" type="email" class="rounded bg-gray-100 mb-5 py-6 pl-2 text-black w-full form-control @error('email') border-2 border-red-600 @enderror" name="email" value="{{ old('email') }}" required>
                        @error('email')
                        <span role="alert">
                            <strong>{{ $message }}</strong><br>
                        </span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="col-md-6">
                    <label for="password" class="text-small text-white">{{ __('general.password') }}</label>
                    <input id="password" type="password" class="rounded bg-gray-100 mb-5 py-6 pl-2 w-full form-control @error('password') is-invalid @enderror" name="password" required>
                        @error('password')
                        <span role="alert">
                            <strong>{{ $message }}</strong><br>
                        </span>
                        @enderror
                    </div>
                   
                    {{-- Password Confirmation --}}
                    <div class="col-md-6">
                    <label for="password-confirm" class="text-small text-white">{{ __('general.confirm_password') }}</label>
                    <input id="password-confirm" type="password" class="rounded bg-gray-100 mb-5 py-6 pl-2 w-full form-control" name="password_confirmation" required>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-4">
                                <button type="submit" class="mt-4 transition duration-200 ease-in-out bg-orange-500 font-bold text-white py-6 px-10 rounded hover:bg-gray-200 hover:text-gray-600">{{ __('general.register') }}</button>
                            </div>
                            <div class="col-auto text-right">
                                <a href="{{ url()->previous() }}">
                                <div
                                    class="mt-8 transition duration-200 ease-in-out bg-white font-bold text-orange-500 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                                    {{ __('general.cancel') }}
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>

                  </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection