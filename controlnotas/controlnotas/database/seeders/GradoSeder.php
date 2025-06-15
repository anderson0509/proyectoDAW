<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradoSeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array([
            'nombre' => 'Primer grado',
            'seccion' => 'UNICA',
            'created_at' => Carbon::now() 
        ],[
            'nombre' => 'Segundo grado',
            'seccion' => 'UNICA',
            'created_at' => Carbon::now() 
        ],[
            'nombre' => 'Tercer grado',
            'seccion' => 'Unica',
            'created_at' => Carbon::now() 
        ],[
            'nombre' => 'Cuarto grado',
            'seccion' => 'UNICA',
            'created_at' => Carbon::now() 
        ],[
            'nombre' => 'Quinto grado',
            'seccion' => 'UNICA',
            'created_at' => Carbon::now() 
        ],[
            'nombre' => 'Sexto grado',
            'seccion' => 'UNICA',
            'created_at' => Carbon::now() 
        ],[
            'nombre' => 'Septimo grado',
            'seccion' => 'UNICA',
            'created_at' => Carbon::now() 
        ],[
            'nombre' => 'Octavo grado',
            'seccion' => 'UNICA',
            'created_at' => Carbon::now() 
        ],[
            'nombre' => 'Noveno grado',
            'seccion' => 'UNICA',
            'created_at' => Carbon::now() 
        ]);

        //insertar los datos 
        DB::table('grado')->insert($data);
    }
}
