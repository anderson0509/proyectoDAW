<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Docente extends Model
{
    use HasFactory;
    protected $table = "docente";
    protected $primaryKey = 'codigo';
    protected $fillable = ['nombre', 'nombre','apellido','dui','correo','telefono','especialidad'];

    public $hidden = ['created_at', 'updated_at'];
    public $timestamps = true;

    public static function getFilteredData($search) {
        return Docente::select('docente.*')

            ->where('docente.codigo', 'like', $search)
            ->orWhere('docente.nombre', 'like', $search);
    }

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage) {
        //se utiliza self para invocar metodo static dentro de la misma clase
        $query = self::getFilteredData($search);
        if ($itemsPerPage !== -1) {//validar para extraer todos los datos
            $query->skip($skip)
                ->take($itemsPerPage);
        }
        $query->orderBy("docente.$sortBy", $sort);
            
        return $query->get();
            
    }
}
