<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('recursos/sweetalert/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('recursos/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
</head>
<body>
    {{--Inicio del menu--}}
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Control de Notas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Inicio</a>
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
                <a class="nav-link" href="/docentes">Docentes</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/detalledocentes">Asignacion</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/notas">Notas</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    {{--Finaliza el menu--}}
    {{--Agregando token de validacion--}}
    @csrf
    
    {{--Inicia el contenido--}}
    <div class="container">
        @yield('content')
    </div>
    {{--Finaliza el contenido--}}
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