{{--heredamos la estructura del archivo app.blade.php--}}
@extends('layouts.app')

{{--Definir un titulo--}}
@section('title', 'docentes')

{{--Definir el contenido--}}
@section('content')
    <hr>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item"><a href="/encargados">Encargados</a></li>
            <li class="breadcrumb-item"><a href="/alumnos">Alumnos</a></li>
            <li class="breadcrumb-item"><a href="/matriculas">Matriculas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Docentes</li>
        </ol>
    </nav>
    <hr>
    <div class="card">
        <div class="card-header">
            <div class="row text-center">
                <div class="col">
                    <h3>Listado de Docentes</h3>
                </div>
                <div class="col">
                    <button class="btn btn-md btn-dark" id="addForm" path="/docentes/create" data-bs-toggle="modal" data-bs-target="#myModal">
                        Registrar
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered" id="datatables">
                <thead>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DUI</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Especialidad</th>
                    <th>Acciones</th>
                </thead>
            </table>
        </div>
    </div>
    @endsection

    @section('scripts')
        <script type="text/javascript">
            $(document).ready(function () {
                var ruta = "/docentes/show";
                var columnas = [
                    {data: 'codigo'},
                    {data: 'nombre'},
                    {data: 'apellido'},
                    {data: 'dui'},
                    {data: 'correo'},
                    {data: 'telefono'},
                    {data: 'especialidad'},
                    {data: 'codigo'}
                ]
                dt = generateDataTable(ruta, columnas);
            });
        </script>
    @endsection