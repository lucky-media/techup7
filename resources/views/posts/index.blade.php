@extends('layouts.app')
    
@section('content')

<div style="background:url({{ asset('/storage/title_img.png') }}); ">
    <div class="container">
        <div class="row items-center justify-between py-20">
            <div class="col-6">
                <h2 class="text-4xl">{{ __('general.blog') }}</h2>
            </div>
        </div>
    </div>
</div>

{{-- Display all posts --}}
<livewire:search-posts >

@endsection