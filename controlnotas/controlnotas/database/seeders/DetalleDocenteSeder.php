<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetalleDocenteSeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array([
            'docente' => 1,
            'grado' => 1,
            'materia' => 1,
            'created_at' => Carbon::now() 
        ],[
            'docente' => 2,
            'grado' => 2,
            'materia' => 4,
            'created_at' => Carbon::now() 
        ],[
            'docente' => 3,
            'grado' => 3,
            'materia' => 5,
            'created_at' => Carbon::now() 
        ]);

        //insertar los datos 
        DB::table('detalle_docente')->insert($data);
    }
}
