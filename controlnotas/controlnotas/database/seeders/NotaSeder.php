<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotaSeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array([
            'matricula' => 1,
            'trimestre' => 1,
            'actividad1' => 10,
            'actividad2' => 10,
            'actividad3' => 10,
            'created_at' => Carbon::now()
            ],[
            'matricula' => 2,
            'trimestre' => 1,
            'actividad1' => 10,
            'actividad2' => 10,
            'actividad3' => 10,
            'created_at' => Carbon::now()
            ],[
            'matricula' => 3,
            'trimestre' => 1,
            'actividad1' => 10,
            'actividad2' => 10,
            'actividad3' => 10,
            'created_at' => Carbon::now()
            ]);

            //insertar los datos 
        DB::table('nota')->insert($data);
    }
}
