<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Encargado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlumnoController extends Controller
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
        return view('/alumnos/show');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $encargado = Encargado::all();//Extraer todos los encargados
        return view('/alumnos/create')->with(['encargado' => $encargado]);
    }

    public function Validarcampos($request){
        return validator::make($request->all(),[
            'nie' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required',
            'imagen' => 'required',
            'fecha_nacimiento' => 'required',
            'encargado' => 'required'
        ],[
            'nie.required' => 'Nie es obligatorio',
            'nombre.required' => 'Nombre es obligatoio',
            'apellido.required' => 'Apellido es obligatoio',
            'correo.required' => 'Correo es obligatoio',
            'imagen.required' => 'Imagen es obligatoio',
            'fecha_nacimiento.required' => 'Fecha es obligatoio',
            'encargado.required' => 'Encargado es obligatorio',
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
            $categorias = Alumno::create($request->all());
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
            $itemsPerPage =  Alumno::count();
            $skip = 0;
        }

        //config to ordering
        $sortBy = $request->input('columns.'.$request->input('order.0.column').'.data','codigo');
        $sort = ($request->input('order.0.dir') === 'asc') ? 'asc' : 'desc';

        //config to search
        $search = $request->input('search.value', '');
        $search = "%$search%";

        //get register filtered
        $filteredCount = Alumno::getFilteredData($search)->count();
        $alumno = Alumno::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage);
        //esto es para reutilizar la funcion para generar datatable en functions.js
        $alumno = $alumno->map(function ($alumno) {
            $alumno->path = 'alumnos';//sirve para la url de editar y eliminar
            return $alumno;
        });
        //se retorna una array estructurado para el data table
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => Alumno::count(),
            'recordsFiltered' => $filteredCount,
            'data' => $alumno]);
            
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $encargado = Encargado::all();//Extraer todas las Encargados
        $alumno = Alumno::where('codigo', $id)->first();
        return view('/alumnos/update')->with([
            'alumno' => $alumno,
            'nie' => $alumno,
            'nombre' => $alumno,
            'apellido'=> $alumno,
            'correo' => $alumno,
            'fecha_nacimiento' => $alumno,
            'imagen' => $alumno,
            'encargado' => $encargado
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
            $alumno = Alumno::find($id);
            if($alumno){
                $alumno->update([
                    'nie' => $request->nie,
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                    'correo' => $request->correo,
                    'fecha_nacimiento' => $request->fecha_nacimiento,
                    'imagen' => $request->imagen,
                    'encargado' => $request->encargado
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
            $alumno = Alumno::find($id);
            
            if($alumno) {
                $alumno->delete();
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
