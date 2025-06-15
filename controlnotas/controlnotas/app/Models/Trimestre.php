<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trimestre extends Model
{
    use HasFactory;
    protected $table = "trimestre";
    protected $primaryKey = 'codigo';
    protected $fillable = ['nombre',];

    public $hidden = ['created_at', 'updated_at'];
    public $timestamps = true;

    public static function getFilteredData($search) {
        return Trimestre::select('trimestre.*')

            ->where('trimestre.codigo', 'like', $search)
            ->orWhere('trimestre.nombre', 'like', $search);
    }

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage) {
        //se utiliza self para invocar metodo static dentro de la misma clase
        $query = self::getFilteredData($search);
        if ($itemsPerPage !== -1) {//validar para extraer todos los datos
            $query->skip($skip)
                ->take($itemsPerPage);
        }
        $query->orderBy("trimestre.$sortBy", $sort);
            
        return $query->get();
            
    }
}
