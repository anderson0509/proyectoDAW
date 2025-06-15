<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DocenteController extends Controller
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
        return view('/docentes/show');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('/docentes/create');
    }

    public function Validarcampos($request){
        return validator::make($request->all(),[
            'nombre' => 'required',
            'apellido' => 'required',
            'dui' => 'required',
            'correo' => 'required',
            'telefono' => 'required',
            'especialidad' => 'required',
        ],[
            'nombre.required' => 'Nombre es obligatoio',
            'apellido.required' => 'Apellido es obligatoio',
            'dui.required' => 'DUI es obligatorio',
            'correo.required' => 'Correo es obligatoio',
            'telefono.required' => 'Telefon es obligatoio',
            'especialidad.required' => 'Especialidad es obligatoio'
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
            $docente = Docente::create($request->all());
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
            $itemsPerPage =  Docente::count();
            $skip = 0;
        }

        //config to ordering
        $sortBy = $request->input('columns.'.$request->input('order.0.column').'.data','codigo');
        $sort = ($request->input('order.0.dir') === 'asc') ? 'asc' : 'desc';

        //config to search
        $search = $request->input('search.value', '');
        $search = "%$search%";

        //get register filtered
        $filteredCount = Docente::getFilteredData($search)->count();
        $docente = Docente::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage);
        //esto es para reutilizar la funcion para generar datatable en functions.js
        $docente = $docente->map(function ($docente) {
            $docente->path = 'docentes';//sirve para la url de editar y eliminar
            return $docente;
        });
        //se retorna una array estructurado para el data table
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => Docente::count(),
            'recordsFiltered' => $filteredCount,
            'data' => $docente]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $docente = Docente::where('codigo', $id)->first();
        return view('/docentes/update')->with([
            'docente' => $docente,
            'nombre' => $docente,
            'apellido'=> $docente,
            'dui' => $docente,
            'correo' => $docente,
            'telefono' => $docente,
            'especialidad' => $docente,
            
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
            $docente = Docente::find($id);
            if($docente){
                $docente->update([
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                    'dui' => $request->dui,
                    'correo' => $request->correo,
                    'telefono' => $request->telefono,
                    'especialidad' => $request->especialidad
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
            $docente = Docente::find($id);
            
            if($docente) {
                $docente->delete();
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
