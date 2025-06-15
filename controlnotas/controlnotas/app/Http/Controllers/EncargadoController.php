<?php

namespace App\Http\Controllers;

use App\Models\Encargado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Scalar\Encapsed;

class EncargadoController extends Controller
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
        return view('/encargados/show');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('/encargados/create');
    }

    public function Validarcampos($request){
        return validator::make($request->all(),[
            'dui' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required',
            'parentesco' => 'required',
        ],[
            'dui.required' => 'DUI es obligatorio',
            'nombre.required' => 'Nombre es obligatoio',
            'apellido.required' => 'Apellido es obligatoio',
            'correo.required' => 'Correo es obligatoio',
            'parentesco.required' => 'Parentesco es obligatoio',
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
            $categorias = Encargado::create($request->all());
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
            $itemsPerPage =  Encargado::count();
            $skip = 0;
        }

        //config to ordering
        $sortBy = $request->input('columns.'.$request->input('order.0.column').'.data','codigo');
        $sort = ($request->input('order.0.dir') === 'asc') ? 'asc' : 'desc';

        //config to search
        $search = $request->input('search.value', '');
        $search = "%$search%";

        //get register filtered
        $filteredCount = Encargado::getFilteredData($search)->count();
        $encargado = Encargado::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage);
        //esto es para reutilizar la funcion para generar datatable en functions.js
        $encargado = $encargado->map(function ($encargado) {
            $encargado->path = 'encargados';//sirve para la url de editar y eliminar
            return $encargado;
        });
        //se retorna una array estructurado para el data table
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => Encargado::count(),
            'recordsFiltered' => $filteredCount,
            'data' => $encargado]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $encargado = Encargado::where('codigo', $id)->first();
        return view('/encargados/update')->with([
            'encargado' => $encargado,
            'dui' => $encargado,
            'nombre' => $encargado,
            'apellido'=> $encargado,
            'correo' => $encargado,
            'parentesco' => $encargado
            
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
            $encargado = Encargado::find($id);
            if($encargado){
                $encargado->update([
                    'dui' => $request->dui,
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                    'correo' => $request->correo,
                    'parentesco' => $request->parentesco,
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
            $encargado = Encargado::find($id);
            
            if($encargado) {
                $encargado->delete();
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
