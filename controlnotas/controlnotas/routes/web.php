<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\EncargadoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\DetalledocenteController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ExpedienteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Alumno;

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

//Rutas para los reportes
Route::get('/notas/pdf', [NotaController::class, 'pdf'])->name('notas.pdf');
Route::get('/notas/pdf-individual/{id}', [NotaController::class, 'pdfIndividual'])->name('notas.pdf.individual');
Route::get('/reportes/alumnos-por-grado', [ReporteController::class, 'alumnosPorGrado'])->name('reportes.alumnos-por-grado');
Route::post('/asistencias/guardar', [ReporteController::class, 'guardar'])->name('asistencias.guardar');
Route::get('/expediente/{alumno}', [ExpedienteController::class, 'show'])->name('expediente.show');


//rutas para encargado
Route::resource('/encargados', EncargadoController::class);

//rutas de alumnos
Route::get('/alumnos', [AlumnoController::class, 'index']);
Route::get('/alumnos/show', [AlumnoController::class, 'show']);
Route::get('/alumnos/create', [AlumnoController::class, 'create']);
Route::post('/alumnos', [AlumnoController::class, 'store']);
Route::get('/alumnos/{id}/edit', [AlumnoController::class, 'edit']);
Route::put('/alumnos/{id}', [AlumnoController::class, 'update']);
Route::delete('/alumnos/{id}', [AlumnoController::class, 'destroy']);

//rutas para docente
Route::resource('/docentes', DocenteController::class);

//Rutas para Matriculas
Route::resource('/matriculas', MatriculaController::class);

//rutas para detalledocente
Route::resource('/detalledocentes', DetalledocenteController::class);

//rutas para notas
Route::resource('/notas', NotaController::class);




Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
