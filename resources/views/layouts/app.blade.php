<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css">
    <link rel="stylesheet" href="/css/intranet.css">

    <style>
        .result-set { margin-top: 1em }
    </style>

    @if(!empty($cssTags))
        @foreach ($cssTags as $css_item)
            {!! $css_item !!}
        @endforeach
    @endif

    @if(!empty($jsHeader))
        @foreach ($jsHeader as $js_item)
            {!! $js_item !!}
        @endforeach
    @endif

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([ 'csrfToken' => csrf_token() ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header{{ (Auth::guest()) ? ' nav-bar-guest' : '' }}">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Cambiar Navegación</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('img/logo-novatech.png') }}"/>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if(Auth::check())
                            @can('view_services')
                                <li class="{{ Request::is('services*') ? 'active' : '' }}">
                                    <a href="{{ route('services.index') }}">Services</a>
                                </li>
                            @endcan
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if(Auth::guest())
                            {{--<li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>--}}
                        @else
                            @if(Auth::user()->roles->first()->id != env('CAS_USER'))
                                <li class="{{ Request::is('crud*') ? 'active' : '' }}">
                                    <a href="{{ route('crud.index') }}">Menu</a>
                                </li>
                            @endif

                            @can('view_users')
                            <li class="{{ Request::is('users*') ? 'active' : '' }}">
                                <a href="{{ route('users.index') }}">
                                    <!--<span class="text-info glyphicon glyphicon-user"></span>--> Usuarios
                                </a>
                            </li>
                            @endcan

                            @can('view_roles')
                            <li class="{{ Request::is('roles*') ? 'active' : '' }}">
                                <a href="{{ route('roles.index') }}">Roles</a>
                            </li>
                            @endcan

                            @can('view_states')
                            <li class="{{ Request::is('states*') ? 'active' : '' }}">
                                <a href="{{ route('states.index') }}">Estados</a>
                            </li>
                            @endcan

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                    <span class="label label-success">{{ Auth::user()->roles->pluck('name')->first() }}</span>
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="glyphicon glyphicon-log-out"></i> Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div id="flash-msg">
                @include('flash::message')
            </div>
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @if(!empty($jsFooter))
        @foreach ($jsFooter as $js_item)
            {!! $js_item !!}
        @endforeach
    @endif

    @stack('scripts')

    <script>
        $(function () {
            // flash auto hide
            $('#flash-msg .alert').not('.alert-danger, .alert-important').delay(6000).slideUp(500);
        })
    </script>
</body>
</html>
