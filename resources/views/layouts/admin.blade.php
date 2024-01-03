<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!--bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.min.css" integrity="sha384-fFxL8wXRpg9gVqGpY+URMtLr3fLL0WBbo4NBQ+IWwMDYjIjI5VQ46XlJm5+BUlXJ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body style="padding:60px 0;">
    <div id="app">
        @include ('layouts.Adminheader')

        <main class="py-4 mt-3">
            @yield('content')
        </main>

        @include ('layouts.footer')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('script')
    <script src="{{asset('js/jquery.js')}}"></script>
</body>

</html>