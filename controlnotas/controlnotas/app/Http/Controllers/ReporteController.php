<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use App\Models\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function alumnosPorGrado(Request $request)
    {
        // Obtener fecha seleccionada o usar la actual
        $fecha = $request->input('fecha', date('Y-m-d'));
        
        // Obtener todos los grados
        $grados = Grado::all();
        
        // Preparar datos para la vista
        $datosGrados = [];
        
        foreach ($grados as $grado) {
            // Obtener matrículas por grado
            $matriculas = Matricula::with(['alumnoRelacion', 'materiaRelacion'])
                ->where('grado', $grado->codigo)
                ->get()
                ->groupBy('alumno');
            
            $alumnosData = [];
            
            foreach ($matriculas as $alumnoId => $matriculasAlumno) {
                $alumno = $matriculasAlumno->first()->alumnoRelacion;
                
                // Obtener asistencias desde cache/sesión
                $asistencias = Cache::get("asistencia_{$grado->codigo}_{$alumnoId}_{$fecha}", [
                    'Lunes' => false,
                    'Martes' => false,
                    'Miércoles' => false,
                    'Jueves' => false,
                    'Viernes' => false
                ]);
                
                $alumnosData[] = [
                    'info' => $alumno,
                    'asistencias' => $asistencias,
                    'matriculas_ids' => $matriculasAlumno->pluck('codigo')->toArray()
                ];
            }
            
            $datosGrados[] = [
                'grado' => $grado,
                'alumnos' => $alumnosData,
                'dias_semana' => ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'],
                'fecha_actual' => $fecha
            ];
        }
        
        return view('reportes.alumnos_por_grado', compact('datosGrados'));
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'grado_id' => 'required|exists:grado,codigo',
            'fecha' => 'required|date',
            'alumnos' => 'required|array'
        ]);

        $gradoId = $request->grado_id;
        $fecha = $request->fecha;

        foreach ($request->alumnos as $alumnoCodigo => $data) {
            // Preparar datos de asistencia
            $asistencias = [
                'Lunes' => $data['dias'][0] ?? false,
                'Martes' => $data['dias'][1] ?? false,
                'Miércoles' => $data['dias'][2] ?? false,
                'Jueves' => $data['dias'][3] ?? false,
                'Viernes' => $data['dias'][4] ?? false
            ];

            // Guardar en cache (expira en 30 días)
            Cache::put(
                "asistencia_{$gradoId}_{$alumnoCodigo}_{$fecha}", 
                $asistencias,
                now()->addDays(30)
            );
        }

        return back()->with('success', 'Asistencias guardadas temporalmente');
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
