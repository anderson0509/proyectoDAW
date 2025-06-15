<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Nota;
use App\Models\Trimestre;
use App\Models\Alumno;
use App\Models\Materia;
use App\Models\Grado;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

class NotaController extends Controller
{
     //Constructor de clase
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('/notas/show');
    }

    public function pdf(){
            $nota = Nota::select('nota.*',            
            'trimestre.nombre AS trimestre_nombre',            
            'matricula.año_matricula AS año',            
            'alumno.nombre AS nombre_alumno',            
            'materia.nombre AS nombre_materia',            
            'grado.nombre AS grado_nombre',            
            // Aproximar las notas individuales                    
            Nota::raw("ROUND(actividad1, 0) AS actividad1_aproximada"),            
            Nota::raw("ROUND(actividad2, 0) AS actividad2_aproximada"),            
            Nota::raw("ROUND(actividad3, 0) AS actividad3_aproximada"),            
            // Calcular promedio con notas aproximadas                    
            Nota::raw("ROUND((ROUND(actividad1, 0) + ROUND(actividad2, 0) + ROUND(actividad3, 0)) / 3, 2) AS promedio"),            
            Nota::raw("CASE                                            
            WHEN (ROUND(actividad1, 0) + ROUND(actividad2, 0) + ROUND(actividad3, 0))/3 >= 6 THEN 'Aprobado'                                            
            ELSE 'Reprobado'                                            
            END AS estado"))            
            ->join("trimestre", "trimestre.codigo", "=", "nota.trimestre")            
            ->join("matricula", "matricula.codigo", "=", "nota.matricula")            
            ->join("alumno", "alumno.codigo", "=", "matricula.alumno")            
            ->join("materia", "materia.codigo", "=", "matricula.materia")            
            ->join("grado", "grado.codigo", "=", "matricula.grado")            
            ->orderBy("nota.codigo", "asc")            
            ->get();        
            $pdf = Pdf::loadView('notas.pdf', \compact('nota'));        
            return $pdf->download('notas.pdf');
    }
public function pdfIndividual($id)
{
    $nota = Nota::select('nota.*',            
        'trimestre.nombre AS trimestre_nombre',            
        'matricula.año_matricula AS año',            
        'alumno.nombre AS nombre_alumno',            
        'materia.nombre AS nombre_materia',            
        'grado.nombre AS grado_nombre',            
        Nota::raw("ROUND(actividad1, 0) AS actividad1_aproximada"),            
        Nota::raw("ROUND(actividad2, 0) AS actividad2_aproximada"),            
        Nota::raw("ROUND(actividad3, 0) AS actividad3_aproximada"),            
        Nota::raw("ROUND((ROUND(actividad1, 0) + ROUND(actividad2, 0) + ROUND(actividad3, 0)) / 3, 2) AS promedio"),            
        Nota::raw("CASE                                            
            WHEN (ROUND(actividad1, 0) + ROUND(actividad2, 0) + ROUND(actividad3, 0))/3 >= 6 THEN 'Aprobado'                                            
            ELSE 'Reprobado'                                            
            END AS estado"))            
        ->join("trimestre", "trimestre.codigo", "=", "nota.trimestre")            
        ->join("matricula", "matricula.codigo", "=", "nota.matricula")            
        ->join("alumno", "alumno.codigo", "=", "matricula.alumno")            
        ->join("materia", "materia.codigo", "=", "matricula.materia")            
        ->join("grado", "grado.codigo", "=", "matricula.grado")            
        ->where('nota.codigo', $id)->first();
        
    $pdf = Pdf::loadView('notas.pdf_individual', compact('nota'));        
    return $pdf->download('notas.pdf_individual');
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nombre_alumno = Matricula::all();//Extraer todos los matriculas
        $trimestre = Trimestre::all();//Extraer todos los trimestre
        $alumno = Alumno::all();//Extraer todos los alumnos
        $materia = Materia::all();//Extraer todos las materias
        $grado = grado::all();//Extraer todos los grados
        return view('/notas/create')->with([
            'trimestre' => $trimestre,
            'alumno' => $alumno,
            'materia' => $materia,
            'grado' => $grado,
    ]);
    }

    public function Validarcampos($request){
        return validator::make($request->all(),[
            'trimestre' => 'required',
            'alumno' => 'required',
            'materia' => 'required',
            'grado' => 'required',
            'nota1' => 'required',
            'nota2' => 'required',
            'nota3' => 'required'
        ],[
            'trimestre.required' => 'Trimestre es obligatorio',
            'alumno.required' => 'Matricula es obligatorio',
            'grado.required' => 'Grado es obligatoio',
            'materia.required' => 'Materia es obligatoio',
            'nota1.required' => 'Nota 1 es obligatorio',
            'nota2.required' => 'Nota 2 es obligatorio',
            'nota3.required' => 'Nota 3 es obligatorio',
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion = $this->Validarcampos($request);
    if($validacion->fails()){
        return response()->json([
            'code' => 422,
            'message' => $validacion->messages()
        ], 422);
    } else {
        // Primero crear o encontrar la matrícula
        $matricula = Matricula::firstOrCreate([
            'alumno' => $request->alumno,
            'materia' => $request->materia,
            'grado' => $request->grado,
            'año_matricula' => date('Y') // Añadir el año actual
        ]);

        // Luego crear la nota asociada a esa matrícula
        $nota = Nota::create([
            'trimestre' => $request->trimestre,
            'matricula' => $matricula->codigo,
            'actividad1' => $request->nota1,
            'actividad2' => $request->nota2,
            'actividad3' => $request->nota3
        ]);

        return response()->json([
            'code' => 200,
            'message' => "Registro creado"
        ], 200);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $itemsPerPage = $request->input('length', 10);//registros por pagina
        $skip = $request->input('start', 0);//obtener indice inicial

        //para extraer todos los registros
        if ($itemsPerPage == -1) {
            $itemsPerPage =  Nota::count();
            $skip = 0;
        }

        //config to ordering
        $sortBy = $request->input('columns.'.$request->input('order.0.column').'.data','codigo');
        $sort = ($request->input('order.0.dir') === 'asc') ? 'asc' : 'desc';

        //config to search
        $search = $request->input('search.value', '');
        $search = "%$search%";

        //get register filtered
        $filteredCount = Nota::getFilteredData($search)->count();
        $nota = Nota::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage);
        //esto es para reutilizar la funcion para generar datatable en functions.js
        $nota = $nota->map(function ($nota) {
            $nota->path = 'notas';//sirve para la url de editar y eliminar
            return $nota;
        });
        //se retorna una array estructurado para el data table
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => Nota::count(),
            'recordsFiltered' => $filteredCount,
            'data' => $nota]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $nombre_alumno = Matricula::all();//Extraer todos las matriculas
        $trimestre = Trimestre::all();//Extraer todos los trimestre
        $alumno = Alumno::all();//Extraer todos los alumnos
        $materia = Materia::all();//Extraer todos los materias
        $grado = grado::all();//Extraer todos los grados
        $nota = Nota::where('codigo', $id)->first();
        return view('/notas/update')->with([
            'trimestre' => $trimestre,
            'alumno' => $alumno,
            'materia' => $materia,
            'grado' => $grado,
            'nota' => $nota
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $validacion = $this->Validarcampos($request);
    if($validacion->fails()){
        return response()->json([
            'code' => 422,
            'message' => $validacion->messages()
        ], 422);
    } else {
        $nota = Nota::find($id);
        if($nota){
            // Actualizar la matrícula primero
            $matricula = Matricula::find($nota->matricula);
            $matricula->update([
                'alumno' => $request->alumno,
                'materia' => $request->materia,
                'grado' => $request->grado
            ]);
            
            // Actualizar la nota
            $nota->update([
                'trimestre' => $request->trimestre,
                'actividad1' => $request->nota1,
                'actividad2' => $request->nota2,
                'actividad3' => $request->nota3
            ]);
            
            return response()->json([
                'code' => 200,
                'message' => "Registro actualizado"
            ], 200);
        } else {
            return response()->json([
                'code' => 400,
                'message' => "Registro no encontrado"
            ], 400);
        }
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $nota = Nota::find($id);
            
            if($nota) {
                $nota->delete();
                return response()->json([
                    'code' => 200,
                    'message' => "Registro Eliminado"
                ], 200);
            } else {
                return response()->json([
                    'code' => 404, 
                    'message' => "Registro no encontrado"
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => "Error al eliminar el registro",
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
