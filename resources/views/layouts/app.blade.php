<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="shortcut icon" href="https://prodis.cat/wp-content/uploads/2015/10/favicon-32x32.png" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}

    <!-- Bootsrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

</head>

<style>
    html, body {
        max-width: 100%;
        overflow-x: hidden;
    }
</style>

<body style="font-family:'Nunito'">
    <div id="app" style="display: flex; min-height: 100vh; flex-direction: column; justify-content: space-between;">
        <nav class="navbar navbar-expand-md navbar-light bg-gradient text-white shadow-sm" style="background-color: #008570">
            <div class="container">
                <a class="navbar-brand text-white mx-2" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo-prodis-white.png') }}" alt="Logo de Prodis" style="width:100px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @if (Auth::check())
                            @if (Auth::user()->admin)
                            <li class="nav-item"><a class="nav-link mx-2" style="text-decoration:none;color:white;" hreflang="ca"
                                href="{{ route("offers.create") }}" lang="ca">{{ __("Crear oferta") }}</a></li>
                            <li class="nav-item"><a class="nav-link mx-2" style="text-decoration:none;color:white;" hreflang="ca"
                                href="{{ route("users.create") }}" lang="ca">{{ __("Crear usuario") }}</a></li>
                            @endif
                        @endif
                        <li class="nav-item"><a class="nav-link mx-2" style="text-decoration:none;color:white;" hreflang="ca"
                                href="{{ route("offers.index") }}" lang="ca">{{ __("Ofertas") }}</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Acceder') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Regístrate') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} {{ Auth::user()->surname1 }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('users.show') }}">
                                    {{ __('Mi perfil') }}
                                </a>

                                @if (Auth::check())
                                    @if (Auth::user()->admin)
                                    <a class="dropdown-item" href="{{ route('users.index') }}">
                                        {{ __('Gestionar usuarios') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('categories.index') }}">
                                        {{ __('Gestionar categorias') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('emails.create') }}">
                                        {{ __('Enviar email') }}
                                    </a>
                                    @endif
                                @endif

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Cierra sesión') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <div id="app">
                @include('flash-message')
            </div>
            <script src="/js/alert.js"></script>
            @yield('content')
        </main>

        <footer class="bg-dark mt-5" >
            <div class="row d-flex p-3">
                <p class="col-auto text-white" style="margin: 0% !important; font-size: 13px;">© Prodis 2021 Plaça del Tint, 6 - 08224 Terrassa <br>
                    Horari d'atenció al públic: De dilluns a divendres de 9 a 13h i de 15 a 18h.</p>
                <div class="text-white col-auto"><p class="mt-2">|</p></div>
                <div class="col-auto"><a class="nav-link" style="text-decoration:none;color:white;" 
                    hreflang="ca" href="/language/ca" lang="ca">{{ __('Catalán') }}</a></div>
                <div class="text-white col-auto"><p class="mt-2">|</p></div>
                <div class="col-auto"><a class="nav-link" style="text-decoration:none;color:white;"
                    hreflang="es-ES" href="/language/es" lang="es-ES">{{ __('Español') }}</a></div>
            </div>
            
        </footer>
    </div>
</body>

</html>