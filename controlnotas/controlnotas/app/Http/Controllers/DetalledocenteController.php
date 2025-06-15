<?php

namespace App\Http\Controllers;

use App\Models\Detalledocentes;
use App\Models\Docente;
use App\Models\Grado;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DetalledocenteController extends Controller
{
     //Constructor de clase
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->rol !== 'director') {
                abort(403, 'No tienes permisos para acceder.');
            }
            return $next($request);
        })->only(['index', 'show', 'edit', 'create','store', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('/detalledocentes/show');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $docente = Docente::all();//Extraer todos los docentes
        $grado = Grado::all();//Extraer todos los grados
        $materia = Materia::all();//Extraer todos las  materias
        return view('/detalledocentes/create')->with([
            'docente' => $docente,
            'grado' => $grado,
            'materia' => $materia
        ]);
    }

    public function Validarcampos($request){
        return validator::make($request->all(),[
            'docente' => 'required',
            'grado' => 'required',
            'materia' => 'required',
        ],[
            'docente.required' => 'Docente es obligatorio',
            'grado.required' => 'Grado es obligatoio',
            'materia.required' => 'Materia es obligatoio',
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
            $detalle_docente = Detalledocentes::create($request->all());
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
            $itemsPerPage =  Detalledocentes::count();
            $skip = 0;
        }

        //config to ordering
        $sortBy = $request->input('columns.'.$request->input('order.0.column').'.data','codigo');
        $sort = ($request->input('order.0.dir') === 'asc') ? 'asc' : 'desc';

        //config to search
        $search = $request->input('search.value', '');
        $search = "%$search%";

        //get register filtered
        $filteredCount = Detalledocentes::getFilteredData($search)->count();
        $detalle_docente = Detalledocentes::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage);
        //esto es para reutilizar la funcion para generar datatable en functions.js
        $detalle_docente = $detalle_docente->map(function ($detalle_docente) {
            $detalle_docente->path = 'detalledocentes';//sirve para la url de editar y eliminar
            return $detalle_docente;
        });
        //se retorna una array estructurado para el data table
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => Detalledocentes::count(),
            'recordsFiltered' => $filteredCount,
            'data' => $detalle_docente]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $docente = Docente::all();//Extraer todos los docentes
        $grado = Grado::all();//Extraer todos los grados
        $materia = Materia::all();//Extraer todos las materias
        $detalle_docente = Detalledocentes::where('codigo', $id)->first();
        return view('/detalledocentes/update')->with([
            'docente' => $docente,
            'grado' => $grado,
            'materia' => $materia,
            'detalle_docente' => $detalle_docente
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
            $detalle_docente= Detalledocentes::find($id);
            if($detalle_docente){
                $detalle_docente->update([
                    'docente' => $request->docente,
                    'grado' => $request->grado,
                    'materia' => $request->materia,
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
            $detalle_docente = Detalledocentes::find($id);
            
            if($detalle_docente) {
                $detalle_docente->delete();
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
