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

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{--Carga de archivos adicionales--}}
    <link rel="stylesheet" href="{{ asset('recursos/sweetalert/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('recursos/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md bg-dark border-bottom border-body shadow-sm" data-bs-theme="dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        {{--Agregar Opciones de menu--}}
                        @auth
                            @if(auth()->user()->rol === 'docente')    
                            <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="/home">Inicio</a>
                                </li> 
                                <li class="nav-item">
                                    <a class="nav-link" href="/encargados">Encargados</a>
                                </li>  
                                <li class="nav-item">
                                    <a class="nav-link" href="/alumnos">Alumnos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/matriculas">Matricula</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/notas">Notas</a>
                                </li>                               
                            @else
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="/home">Inicio</a>
                                </li> 
                                <li class="nav-item">
                                    <a class="nav-link" href="/encargados">Encargados</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/alumnos">Alumnos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/matriculas">Matricula</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/docentes">Docente</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/detalledocentes">Asignación</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/notas">Notas</a>
                                </li>                                
                            @endif
                        @endauth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        <main class="container py-4">
            @yield('content')
        </main>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="loadForm">
                ...
            </div>
            </div>
        </div>
    </div>
    {{--archivos js globales--}}
    <script src="{{ asset('recursos/jquery.min.js') }}"></script>
    <script src="{{ asset('recursos/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('recursos/datatables/datatables.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
    <script src="{{ asset('recursos/js/functions.js') }}"></script>
    <script src="{{ asset('recursos/js/custom.js') }}"></script>
    {{-- Cargar scripts de cada vista  --}}
    @yield('scripts')
</body>
</html>
