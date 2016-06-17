<?php

use Illuminate\Database\Seeder;

class ProfesionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profesiones')->insert([
            'titulo' => 'Análisis de Sistemas',
            'grado_id' => 1,
        ]);
        DB::table('profesiones')->insert([
            'titulo' => 'Sistemas',
            'grado_id' => 2,
        ]);
        DB::table('profesiones')->insert([
            'titulo' => 'Informática',
            'grado_id' => 3,
        ]);
    }
}
