<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocenteSeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array([
            'nombre' => 'Rony',
            'apellido' => 'Aguilar',
            'dui' => '05258897-2',
            'correo' => 'rony.aguilar@edu.sv',
            'telefono' => '7688-9834',
            'especialidad' => 'matematica',
            'created_at' => Carbon::now() 
        ],[
            'nombre' => 'Anderson',
            'apellido' => 'Cuellar',
            'dui' => '05258758-2',
            'correo' => 'anderson.cuellar@edu.sv',
            'telefono' => '7598-7834',
            'especialidad' => 'Ciencia',
            'created_at' => Carbon::now() 
        ],[
            'nombre' => 'Karla',
            'apellido' => 'Catalan',
            'dui' => '05248598-2',
            'correo' => 'karla.catalan@edu.sv',
            'telefono' => '7888-9635',
            'especialidad' => 'Ingles',
            'created_at' => Carbon::now() 
        ]);

        //insertar los datos 
        DB::table('docente')->insert($data);
    }
}
