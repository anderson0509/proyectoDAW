<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grado extends Model
{
    use HasFactory;
    protected $table = "grado";
    protected $primaryKey = 'codigo';
    protected $fillable = ['nombre', 'seccion'];

    public $hidden = ['created_at', 'updated_at'];
    public $timestamps = true;

    public static function getFilteredData($search) {
        return Grado::select('grado.*')

            ->where('grado.codigo', 'like', $search)
            ->orWhere('grado.nombre', 'like', $search);
    }

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage) {
        //se utiliza self para invocar metodo static dentro de la misma clase
        $query = self::getFilteredData($search);
        if ($itemsPerPage !== -1) {//validar para extraer todos los datos
            $query->skip($skip)
                ->take($itemsPerPage);
        }
        $query->orderBy("grado.$sortBy", $sort);
            
        return $query->get();
            
    }
}
