@extends('layouts.app')
    
@section('content')


<div style="background:url({{ asset('/storage/title_img.png') }}); ">
    <div class="container">
        <div class="row items-center justify-between py-20">
            <div class="col-6">
                <h2 class="text-4xl">{{ __('general.try_our_courses') }}</h2>
            </div>
        </div>
    </div>
</div>

@livewire('search-courses')

@endsection