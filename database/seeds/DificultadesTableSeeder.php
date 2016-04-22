<?php

use Illuminate\Database\Seeder;

class DificultadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dificultades')->insert([
            'nombre' => 'Básico',
        ]);
        DB::table('dificultades')->insert([
            'nombre' => 'Intermedio',
        ]);
        DB::table('dificultades')->insert([
            'nombre' => 'Avanzado',
        ]);
    }
}
