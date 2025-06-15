{{--heredamos la estructura del archivo app.blade.php--}}
@extends('layouts.app')

{{--Definir un titulo--}}
@section('title', 'Inicio')

{{--Definir el contenido--}}
@section('content')
    <hr>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Inicio</li>
        </ol>
    </nav>
    <hr>
    <h1>Pantalla de Inicio</h1>
    <hr>
    <h1>Integrantes del Equipo</h1><br>
    <h3>Rony Alexander Aguilar Santos - 022524<h3>
    <h3>Karla Gabriela Catalán Sosa - 025924</h3>
    <h3>Anderson Leopoldo Cuellar Carpio- 022424</h3>
    <hr>
@endsection
