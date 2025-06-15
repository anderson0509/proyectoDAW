<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatriculaSeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array([
            'alumno' => 1,
            'grado' => 1,
            'materia' => 1,
            'año_matricula' => Carbon::now()->year,
            'created_at' => Carbon::now() 
        ],[
            'alumno' => 2,
            'grado' => 2,
            'materia' => 2,
            'año_matricula' => Carbon::now()->year,
            'created_at' => Carbon::now() 
        ],[
            'alumno' => 3,
            'grado' => 3,
            'materia' => 3,
            'año_matricula' => Carbon::now()->year,
            'created_at' => Carbon::now() 
        ]);

        //insertar los datos 
        DB::table('matricula')->insert($data);
    }
}
