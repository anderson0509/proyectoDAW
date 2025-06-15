{{--heredamos la estructura del archivo app.blade.php--}}
@extends('layouts.app')

{{--Definir un titulo--}}
@section('title', 'matriculas')

{{--Definir el contenido--}}
@section('content')
    <hr>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item"><a href="/encargados">Encargados</a></li>
            <li class="breadcrumb-item"><a href="/alumnos">Alumno</a></li>
            <li class="breadcrumb-item active" aria-current="page">Matricula</li>
        </ol>
    </nav>
    <hr>
    <div class="card">
        <div class="card-header">
            <div class="row text-center">
                <div class="col">
                    <h3>Listado de Matriculas</h3>
                </div>
                <div class="col">
                    <button class="btn btn-md btn-dark" id="addForm" path="/matriculas/create" data-bs-toggle="modal" data-bs-target="#myModal">
                        Registrar
                    </button>
                    <a href="{{ route('reportes.alumnos-por-grado') }}" class="btn btn-info">
                            <i class="fas fa-users"></i> Ver Asistencia por Grado
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered" id="datatables">
                <thead>
                    <th>Codigo</th>
                    <th>Alumno</th>
                    <th>Grado</th>
                    <th>Materia</th>
                    <th>Año de Matricula</th>
                    <th>Acciones</th>
                </thead>
            </table>
        </div>
    </div>
    @endsection

    @section('scripts')
        <script type="text/javascript">
            $(document).ready(function () {
                var ruta = "/matriculas/show";
                var columnas = [
                    {data: 'codigo'},
                    {data: 'alumno'},
                    {data: 'grado'},
                    {data: 'materia'},
                    {data: 'año_matricula'},
                    {data: 'codigo'}
                ]
                dt = generateDataTable(ruta, columnas);
            });
        </script>
    @endsection