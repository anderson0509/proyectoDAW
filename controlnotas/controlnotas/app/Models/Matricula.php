<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matricula extends Model
{
    use HasFactory;
    protected $table = "matricula";
    protected $primaryKey = 'codigo';
    protected $fillable = ['alumno', 'grado','materia','año_matricula'];

    public $hidden = ['created_at', 'updated_at'];
    public $timestamps = true;

    public static function getFilteredData($search) {
        return Matricula::select('matricula.*', 'alumno.nombre AS alumno', 'grado.nombre AS grado', 'materia.nombre AS materia')
            ->join("alumno", "alumno.codigo", "=", "matricula.alumno")
            ->join("grado", "grado.codigo", "=", "matricula.grado")
            ->join("materia", "materia.codigo", "=", "matricula.materia")
            
            ->where('matricula.codigo', 'like', $search)
            ->orWhere('alumno.nombre', 'like', $search)
            ->orWhere('grado.nombre', 'like', $search)
            ->orWhere('materia.nombre', 'like', $search)
            ->orWhere('matricula.año_matricula', 'like', $search);
    }
//Relaciones
    public function alumnoRelacion()
    {
        return $this->belongsTo(Alumno::class, 'alumno', 'codigo');
    }

    public function gradoRelacion()
    {
        return $this->belongsTo(Grado::class, 'grado', 'codigo');
    }

    public function materiaRelacion()
    {
        return $this->belongsTo(Materia::class, 'materia', 'codigo');
    }
    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage) {
        $query = self::getFilteredData($search);
        if ($itemsPerPage !== -1) {//validar para extraer todos los datos
            $query->skip($skip)
                ->take($itemsPerPage);
        }
        $query->orderBy("matricula.$sortBy", $sort);
            
        return $query->get();
            
    }
}
