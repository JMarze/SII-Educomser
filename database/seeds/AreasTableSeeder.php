<?php

use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            'nombre' => 'Programación',
        ]);
        DB::table('areas')->insert([
            'nombre' => 'Base de Datos',
        ]);
        DB::table('areas')->insert([
            'nombre' => 'Sitios Web',
        ]);
    }
}
