<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js"
            integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl"
            crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <a href="#" class="navbar-brand">Swappit</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            @guest
                <ul class="navbar-nav mr-auto"></ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                    </li>
                </ul>
            @else
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="" class="dropdown-item">Action</a>
                                <a href="" class="dropdown-item">Action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            @endguest
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-light pt-2">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a href="/festivals" class="nav-link {{ active_menu(Route::currentRouteName(), 'festivals', 0, 9) }}">Festivals</a>
                    </li>
                    <li class="nav-item">
                        <a href="/tickets" class="nav-link {{ active_menu(Route::currentRouteName(), 'tickets', 0, 7) }}">Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a href="/ticket_types" class="nav-link {{ active_menu(Route::currentRouteName(), 'ticket_types', 0, 12) }}">Ticket Types</a>
                    </li>
                    <li class="nav-item">
                        <a href="/users" class="nav-link {{ active_menu(Route::currentRouteName(), 'users', 0, 5) }}">Users</a>
                    </li>
                    <li class="nav-item">
                        <a href="/orders" class="nav-link {{ active_menu(Route::currentRouteName(), 'orders', 0, 6) }}">Orders</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 mt-3">@yield('content')</div>
        </div>
    </div>


    <main class="py-4">

    </main>
</div>
</body>
</html>
