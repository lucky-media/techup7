<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    @stack('styles')
    
    <livewire:styles>

</head>
<body class="font-sans text-black antialiased flex flex-col">
    <div id="app">
        @include('partials.menu')

        @yield('content')

    </div>

    <footer>
        @include('partials.footer')
    </footer> 
    
    <livewire:scripts>
</body>
</html>
