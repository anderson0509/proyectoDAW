<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MateriaSeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =array([
            'nombre' => 'Matematica',
            'created_at' => Carbon::now()
        ],[
            'nombre' => 'Lenguaje',
            'created_at' => Carbon::now()
        ],[
            'nombre' => 'Sociales',
            'created_at' => Carbon::now()
        ],[
            'nombre' => 'Ciencia',
            'created_at' => Carbon::now()
        ],[
            'nombre' => 'Ingles',
            'created_at' => Carbon::now()
        ]);

        //insertar los datos 
        DB::table('materia')->insert($data);
    }
}
