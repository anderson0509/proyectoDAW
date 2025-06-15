<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            DocenteSeder::class,
            GradoSeder::class,
            MateriaSeder::class,
            DetalleDocenteSeder::class,
            EncargadoSeder::class,
            AlumnoSeder::class,
            MatriculaSeder::class,
            TrimestreSeder::class,
            NotaSeder::class
        ]);
    }
}
