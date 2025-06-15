<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detalledocentes extends Model
{
    use HasFactory;
    protected $table = "detalle_docente";
    protected $primaryKey = 'codigo';
    protected $fillable = ['docente', 'grado','materia'];

    public $hidden = ['created_at', 'updated_at'];
    public $timestamps = true;

    public static function getFilteredData($search) {
        return Detalledocentes::select('detalle_docente.*', 'docente.nombre AS docente', 'grado.nombre AS grado', 'materia.nombre AS materia')
            ->join("docente", "docente.codigo", "=", "detalle_docente.docente")
            ->join("grado", "grado.codigo", "=", "detalle_docente.grado")
            ->join("materia", "materia.codigo", "=", "detalle_docente.materia")
            
            ->where('detalle_docente.codigo', 'like', $search)
            ->orWhere('docente.nombre', 'like', $search)
            ->orWhere('grado.nombre', 'like', $search)
            ->orWhere('materia.nombre', 'like', $search);
    }

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage) {
        //se utiliza self para invocar metodo static dentro de la misma clase
        $query = self::getFilteredData($search);
        if ($itemsPerPage !== -1) {//validar para extraer todos los datos
            $query->skip($skip)
                ->take($itemsPerPage);
        }
        $query->orderBy("detalle_docente.$sortBy", $sort);
            
        return $query->get();
            
    }
}
