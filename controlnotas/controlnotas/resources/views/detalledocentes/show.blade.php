{{--heredamos la estructura del archivo app.blade.php--}}
@extends('layouts.app')

{{--Definir un titulo--}}
@section('title', 'detalle_docente')

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
            <li class="breadcrumb-item active" aria-current="page">Asignacion</li>
        </ol>
    </nav>
    <hr>
    <div class="card">
        <div class="card-header">
            <div class="row text-center">
                <div class="col">
                    <h3>Listado de Asignacion de Docentes</h3>
                </div>
                <div class="col">
                    <button class="btn btn-md btn-dark" id="addForm" path="/detalledocentes/create" data-bs-toggle="modal" data-bs-target="#myModal">
                        Registrar
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered" id="datatables">
                <thead>
                    <th>Codigo</th>
                    <th>Docente</th>
                    <th>Grado</th>
                    <th>Materia</th>
                    <th>Acciones</th>
                </thead>
            </table>
        </div>
    </div>
    @endsection

    @section('scripts')
        <script type="text/javascript">
            $(document).ready(function () {
                var ruta = "/detalledocentes/show";
                var columnas = [
                    {data: 'codigo'},
                    {data: 'docente'},
                    {data: 'grado'},
                    {data: 'materia'},
                    {data: 'codigo'}
                ]
                dt = generateDataTable(ruta, columnas);
            });
        </script>
    @endsection