<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Encargado extends Model
{
    use HasFactory;
    protected $table = "encargado";
    protected $primaryKey = 'codigo';
    protected $fillable = ['dui', 'nombre','apellido','correo','parentesco'];

    public $hidden = ['created_at', 'updated_at'];
    public $timestamps = true;

    public static function getFilteredData($search) {
        return Encargado::select('encargado.*')

            ->where('encargado.codigo', 'like', $search)
            ->orWhere('encargado.nombre', 'like', $search);
    }

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage) {
        //se utiliza self para invocar metodo static dentro de la misma clase
        $query = self::getFilteredData($search);
        if ($itemsPerPage !== -1) {//validar para extraer todos los datos
            $query->skip($skip)
                ->take($itemsPerPage);
        }
        $query->orderBy("encargado.$sortBy", $sort);
            
        return $query->get();
            
    }
}
