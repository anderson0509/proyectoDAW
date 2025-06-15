{{--heredamos la estructura del archivo app.blade.php--}}
@extends('layouts.app')

{{--Definir un titulo--}}
@section('title', 'nota')

{{--Definir el contenido--}}
@section('content')
    <hr>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item"><a href="/encargados">Encargados</a></li>
            <li class="breadcrumb-item"><a href="/alumnos">Alumnos</a></li>
            <li class="breadcrumb-item"><a href="/matriculas">Matricula</a></li>
            <li class="breadcrumb-item"><a href="/docentes">Docente</a></li>
            <li class="breadcrumb-item"><a href="/detalledocentes">Asignacion</a></li>
            <li class="breadcrumb-item active" aria-current="page">Nota</li>
        </ol>
    </nav>
    <hr>
    <div class="card">
        <div class="card-header">
            <div class="row text-center">
                <div class="col">
                    <h3>Listado de Notas</h3>
                </div>
                <div class="col">
                    <button class="btn btn-md btn-dark" id="addForm" path="/notas/create" data-bs-toggle="modal" data-bs-target="#myModal">
                        Registrar
                    </button>
                    <a href="{{ route('notas.pdf') }}" class="btn btn-danger">
                        Generar PDF General
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered" id="datatables">
                <thead>
                    <th>Codigo</th>
                    <th>Trimestre</th>
                    <th>Año</th>
                    <th>Matricula</th>
                    <th>Materia</th>
                    <th>Grado</th>
                    <th>Nota 1</th>
                    <th>Nota 2</th>
                    <th>Nota 3</th>
                    <th>Promedio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </thead>
            </table>
        </div>
    </div>
    @endsection

    @section('scripts')
        <script type="text/javascript">
            $(document).ready(function () {
                var ruta = "/notas/show";
                var columnas = [
                    {data: 'codigo'},
                    {data: 'trimestre'},
                    {data: 'año'},
                    {data: 'nombre_alumno'},
                    {data: 'nombre_materia'},
                    {data: 'grado'},
                    {data: 'actividad1'},
                    {data: 'actividad2'},
                    {data: 'actividad3'},
                    {data: 'promedio'},
                    {data: 'estado'},
                    {data: 'codigo'},
                    {data: 'codigo'}
                ]
                dt = generateDataTable(ruta, columnas, true);
            });
        </script>
    @endsection