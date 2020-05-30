@extends('layouts.app')

@section('content')
<div class="container my-20">
    <div class="row justify-center">
        <div class="col-6">
            <div class="bg-blue-500 border rounded mb-10 lg:mb-0">
                <div class="m-10">
                    <h2 class="text-4xl font-bold mb-4">{{ __('general.login') }}</h2>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- EMAIL --}}
                        <div class="col-md-6">
                            <label for="email" class="text-small text-white">{{ __('general.email') }}</label>
                            <input id="email" type="email"
                                class="rounded bg-gray-100 mb-5 py-6 pl-2 text-black w-full form-control @error('email') border-2 border-red-600 @enderror"
                                name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                            <span role="alert">
                                <strong>{{ $message }}</strong><br>
                            </span>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="col-md-6">
                            <label for="password" class="text-small text-white">{{ __('general.password') }}</label>
                            <input id="password" type="password"
                                class="rounded bg-gray-100 mb-5 py-6 pl-2 w-full form-control @error('password') is-invalid @enderror"
                                name="password" required>
                            @error('password')
                            <span role="alert">
                                <strong>{{ $message }}</strong><br>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <br>

                        <div class="col-md-6">
                            <button type="submit"
                                class="mt-4 transition duration-200 ease-in-out bg-orange-500 font-bold text-white py-6 px-10 rounded hover:bg-gray-200 hover:text-gray-600">{{ __('Login') }}</button>
                            @if (Route::has('password.request'))
                            <a class="ml-4 btn btn-link" href="{{ route('password.request') }}">
                                {{ __('general.forgot_your_password') }}
                            </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-center mt-10">
        <div class="col-6 text-center">
            <h4 class="text-2xl font-bold mb-4"><a href="{{ route('register') }}">{{ __('general.not_registered') }}</a></h4>
        </div>
    </div>
</div>
@endsection
