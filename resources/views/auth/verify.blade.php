@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('general.verify_email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('general.a_fresh_verification_link') }}
                        </div>
                    @endif
                    {{ __('general.before_proceeding') }}
                    {{ __('general.if_you_did_not') }}
                    {{ __('') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('general.click_here_to_request') }}.</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
