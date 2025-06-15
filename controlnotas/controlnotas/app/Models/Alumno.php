<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alumno extends Model
{
    use HasFactory;
    protected $table = "alumno";
    protected $primaryKey = 'codigo';
    protected $fillable = ['encargado', 'nie','nombre','apellido','correo','fecha_nacimiento','imagen'];

    public $hidden = ['created_at', 'updated_at'];
    public $timestamps = true;

    public static function getFilteredData($search) {
        return Alumno::select('alumno.*', 'encargado.nombre AS encargado')
            ->join("encargado", "encargado.codigo", "=", "alumno.encargado")

            ->where('alumno.codigo', 'like', $search)
            ->orWhere('alumno.nombre', 'like', $search)
            ->orWhere('encargado.nombre', 'like', $search);
    }

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage) {
        //se utiliza self para invocar metodo static dentro de la misma clase
        $query = self::getFilteredData($search);
        if ($itemsPerPage !== -1) {//validar para extraer todos los datos
            $query->skip($skip)
                ->take($itemsPerPage);
        }
        $query->orderBy("alumno.$sortBy", $sort);
            
        return $query->get();
            
    }
}
