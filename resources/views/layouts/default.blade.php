<!DOCTYPE html>
<html lang="{{ config('app.locale', 'pt-br') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @yield('css')
    </head>
    <body class="app">
        <header class="app-header navbar">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler mobile-sidebar-toggler d-lg-none" type="button">☰</button>
            <ul class="nav navbar-nav d-md-down-none">
                <li class="nav-item">
                    <a class="nav-link navbar-toggler sidebar-toggler" href="#">
                        <i class="icon-logout"></i>
                    </a>
                </li>
            </ul>
        </header>
        <main class="main">
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
    </body>
</html>