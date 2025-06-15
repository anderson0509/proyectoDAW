<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Alumno;
use App\Models\Grado;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatriculaController extends Controller
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
        return view('/matriculas/show');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alumno = Alumno::all();//Extraer todos los alumnos
        $grado = Grado::all();//Extraer todos los Grados
        $materia = Materia::all();//Extraer todos las Materias
        return view('/matriculas/create')->with([
            'alumno' => $alumno,
            'grado' => $grado,
            'materia' => $materia
    ]);
    }

    public function Validarcampos($request){
        return validator::make($request->all(),[
            'alumno' => 'required',
            'grado' => 'required',
            'materia' => 'required',
            'año_matricula' => 'required',
        ],[
            'alumno.required' => 'Alumno es obligatorio',
            'grado.required' => 'Grado es obligatoio',
            'materia.required' => 'Materia es obligatoio',
            'año_matricula.required' => 'El año es obligatoio',
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion = $this->Validarcampos($request);
        if($validacion->fails()){//Verificar validacion
            return response()->json([
                'code' => 422,
                'message' => $validacion->messages()
            ], 422);
        }else{
            $matricula = Matricula::create($request->all());
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
            $itemsPerPage =  Matricula::count();
            $skip = 0;
        }

        //config to ordering
        $sortBy = $request->input('columns.'.$request->input('order.0.column').'.data','codigo');
        $sort = ($request->input('order.0.dir') === 'asc') ? 'asc' : 'desc';

        //config to search
        $search = $request->input('search.value', '');
        $search = "%$search%";

        //get register filtered
        $filteredCount = Matricula::getFilteredData($search)->count();
        $matricula = Matricula::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage);
        //esto es para reutilizar la funcion para generar datatable en functions.js
        $matricula = $matricula->map(function ($matricula) {
            $matricula->path = 'matriculas';//sirve para la url de editar y eliminar
            return $matricula;
        });
        //se retorna una array estructurado para el data table
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => Matricula::count(),
            'recordsFiltered' => $filteredCount,
            'data' => $matricula]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alumno = Alumno::all();//Extraer todos los alumnos
        $grado = Grado::all();//Extraer todos los grados
        $materia = Materia::all();//Extraer todos las materias
        $matricula = Matricula::where('codigo', $id)->first();
        return view('/matriculas/update')->with([
            'alumno' => $alumno,
            'grado' => $grado,
            'materia' => $materia,
            'matricula' => $matricula
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validacion = $this->Validarcampos($request);
        if($validacion->fails()){//Verificar validacion
            return response()->json([
                'code' => 422,
                'message' => $validacion->messages()
            ], 422);
        }else{
            $matricula= Matricula::find($id);
            if($matricula){
                $matricula->update([
                    'alumno' => $request->alumno,
                    'grado' => $request->grado,
                    'materia' => $request->materia,
                    'año_matricula' => $request->año_matricula
                ]);
                return response()->json([
                    'code' => 200,
                    'message' => "Registro actualizado"
                ], 200);
            }else{
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
            $matricula = Matricula::find($id);
            
            if($matricula) {
                $matricula->delete();
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
