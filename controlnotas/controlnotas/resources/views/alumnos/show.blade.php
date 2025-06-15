{{--heredamos la estructura del archivo app.blade.php--}}
@extends('layouts.app')

{{--Definir un titulo--}}
@section('title', 'Alumnos')

{{--Definir el contenido--}}
@section('content')
    <hr>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="/encargados">Encargados</a></li>
            <li class="breadcrumb-item active" aria-current="page">Alumno</li>
        </ol>
    </nav>
    <hr>
    <div class="card">
        <div class="card-header">
            <div class="row text-center">
                <div class="col">
                    <h3>Listado de Alumno</h3>
                </div>
                <div class="col">
                    <button class="btn btn-md btn-dark" id="addForm" path="/alumnos/create" data-bs-toggle="modal" data-bs-target="#myModal">
                        Registrar
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered" id="datatables">
                <thead>
                    <th>Codigo</th>
                    <th>Encargado</th>
                    <th>NIE</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </thead>
            </table>
        </div>
    </div>
    @endsection

    @section('scripts')
        <script type="text/javascript">
            $(document).ready(function () {
                var ruta = "/alumnos/show";
                var columnas = [
                    {data: 'codigo'},
                    {data: 'encargado'},
                    {data: 'nie'},
                    {data: 'nombre'},
                    {data: 'apellido'},
                    {data: 'correo'},
                    {data: 'fecha_nacimiento'},
                    {data: 'imagen'},
                    {data: 'codigo'}
                ]
                dt = generateDataTable(ruta, columnas, false);
            });
        </script>
    @endsection