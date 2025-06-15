<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlumnoSeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array([
            'encargado' => 1,
            'nie' =>28485599,
            'nombre' => 'Alexander',
            'apellido' => 'Perez',
            'correo' => 'alexander.perez@edu.sv',
            'fecha_nacimiento' => Carbon::create(2018, 8, 10),
            'imagen' => '/imagenes/icono.png',
            'created_at' => Carbon::now() 
        ],[
            'encargado' => 2,
            'nie' =>28485589,
            'nombre' => 'Karen',
            'apellido' => 'Ortega',
            'correo' => 'karen.ortega@edu.sv',
            'fecha_nacimiento' => Carbon::create(2017, 6, 15),
            'imagen' => '/imagenes/icono.png',
            'created_at' => Carbon::now() 
        ],[
            'encargado' => 3,
            'nie' =>18455895,
            'nombre' => 'Josue',
            'apellido' => 'Ortiz',
            'correo' => 'josue.ortiz@edu.sv',
            'fecha_nacimiento' => Carbon::create(2016, 7, 10),
            'imagen' => '/imagenes/icono.png',
            'created_at' => Carbon::now() 
        ]);
        //insertar los datos 
        DB::table('alumno')->insert($data);
    }
}
