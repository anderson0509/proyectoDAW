<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nota extends Model
{
    use HasFactory;
    protected $table = "nota";
    protected $primaryKey = 'codigo';
    protected $fillable = ['trimestre', 'matricula','actividad1','actividad2','actividad3'];

    public $hidden = ['created_at', 'updated_at'];
    public $timestamps = true;

    public static function getFilteredData($search) {
        return Nota::select('nota.*', 
        'trimestre.nombre AS trimestre',
        'matricula.año_matricula AS año',
        'alumno.nombre AS nombre_alumno',
        'materia.nombre AS nombre_materia',
        'grado.nombre AS grado',
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

            ->where('nota.codigo', 'like', $search)
            ->orWhere('trimestre.nombre', 'like', $search)
            ->orWhere('matricula.año_matricula', 'like', $search)
            ->orWhere('alumno.nombre', 'like', $search) 
            ->orWhere('materia.nombre', 'like', $search) 
            ->orWhere('grado.nombre', 'like', $search)
            ->orWhere('nota.actividad1', 'like', $search)
            ->orWhere('nota.actividad2', 'like', $search)
            ->orWhere('nota.actividad3', 'like', $search);
    }

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage) {
        //se utiliza self para invocar metodo static dentro de la misma clase
        $query = self::getFilteredData($search);
        if ($itemsPerPage !== -1) {//validar para extraer todos los datos
            $query->skip($skip)
                ->take($itemsPerPage);
        }
        $query->orderBy("nota.$sortBy", $sort);
            
        return $query->get();
            
    }
}
