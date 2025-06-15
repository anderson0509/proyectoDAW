<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EncargadoSeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array([
            'dui' => '05268498-3',
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'correo' => 'juan.perez@gmail.com',
            'parentesco' => 'Padre',
            'created_at' => Carbon::now() 
        ],[
            'dui' => '06268587-3',
            'nombre' => 'Maria',
            'apellido' => 'Ortega',
            'correo' => 'maria.ortega@gmail.com',
            'parentesco' => 'Madre',
            'created_at' => Carbon::now() 
        ],[
            'dui' => '04265788-3',
            'nombre' => 'Jose',
            'apellido' => 'Ortiz',
            'correo' => 'jose.ortiz@gmail.com',
            'parentesco' => 'Padre',
            'created_at' => Carbon::now() 
        ]);

        //insertar los datos 
        DB::table('encargado')->insert($data);
    }
}
