<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Matricula;
use App\Models\Nota;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    private function determinarEstado($matricula)
{
    // Verificar si existe alguna calificación para esta matrícula
    $calificacion = Nota::table('actividad1, actividad2,actividad3')
        ->where('matricula_id', $matricula->codigo)
        ->first();

    if ($calificacion) {
        return $calificacion->nota >= 6 ? 'aprobado' : 'reprobado';
    }
    
    // Si no hay calificación, determinar por año
    $añoActual = date('Y');
    
    if ($matricula->año_matricula < $añoActual) {
        return 'reprobado'; 
    } elseif ($matricula->año_matricula == $añoActual) {
        return 'cursando';
    } else {
        return 'pendiente';
    }
}
    /**
     * Display the specified resource.
     */
    public function show($alumnoId)
    {
        $alumno = Alumno::findOrFail($alumnoId);
        
        // Obtener matrículas con notas y estado calculado
        $matriculas = Matricula::with(['gradoRelacion', 'materiaRelacion'])
            ->where('alumno', $alumnoId)
            ->orderBy('año_matricula', 'desc')
            ->get()
            ->map(function ($matricula) {
                // Obtener todas las notas para esta matrícula
                $notas = Nota::where('matricula', $matricula->codigo)
                    ->select(
                        'trimestre',
                        Nota::raw('ROUND(actividad1, 0) AS actividad1'),
                        Nota::raw('ROUND(actividad2, 0) AS actividad2'),
                        Nota::raw('ROUND(actividad3, 0) AS actividad3'),
                        Nota::raw('ROUND((ROUND(actividad1, 0) + ROUND(actividad2, 0) + ROUND(actividad3, 0)) / 3, 2) AS promedio'),
                        Nota::raw("CASE WHEN (ROUND(actividad1, 0) + ROUND(actividad2, 0) + ROUND(actividad3, 0))/3 >= 6 THEN 'Aprobado' ELSE 'Reprobado' END AS estado")
                    )
                    ->get();
                
                // Agregar datos calculados a la matrícula
                $matricula->notas = $notas;
                $matricula->estado_general = $this->calcularEstadoGeneral($notas);
                
                return $matricula;
            })
            ->groupBy('año_matricula');

        return view('expediente.show', compact('alumno', 'matriculas'));
    }

    private function calcularEstadoGeneral($notas)
    {
        if ($notas->isEmpty()) return 'Sin notas';
        
        $aprobados = $notas->where('estado', 'Aprobado')->count();
        $total = $notas->count();
        
        return $aprobados == $total ? 'Aprobado' : ($aprobados > 0 ? 'Parcial' : 'Reprobado');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
