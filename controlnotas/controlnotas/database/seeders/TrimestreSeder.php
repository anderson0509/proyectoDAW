<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrimestreSeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =array([
            'nombre' => 'Primer Trimestre',
            'created_at' => Carbon::now()
        ],[
            'nombre' => 'Segundo Trimestre',
            'created_at' => Carbon::now()
        ],[
            'nombre' => 'Tercer Trimestre',
            'created_at' => Carbon::now()
        ]);

        //insertar los datos 
        DB::table('trimestre')->insert($data);
    
    }
}
