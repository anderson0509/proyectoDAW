<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materia extends Model
{
    use HasFactory;
    protected $table = "materia";
    protected $primaryKey = 'codigo';
    protected $fillable = ['nombre',];

    public $hidden = ['created_at', 'updated_at'];
    public $timestamps = true;

    public static function getFilteredData($search) {
        return Materia::select('materia.*')

            ->where('materia.codigo', 'like', $search)
            ->orWhere('materia.nombre', 'like', $search);
    }

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage) {
        //se utiliza self para invocar metodo static dentro de la misma clase
        $query = self::getFilteredData($search);
        if ($itemsPerPage !== -1) {//validar para extraer todos los datos
            $query->skip($skip)
                ->take($itemsPerPage);
        }
        $query->orderBy("materia.$sortBy", $sort);
            
        return $query->get();
            
    }
}
