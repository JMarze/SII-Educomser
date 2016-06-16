<?php

use Illuminate\Database\Seeder;

class TiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos')->insert([
            'nombre' => 'Regular',
        ]);
        DB::table('tipos')->insert([
            'nombre' => 'Personalizado',
            'horas_reales' => 15,
        ]);
        DB::table('tipos')->insert([
            'nombre' => 'Sábados',
            'horas_reales' => 16,
        ]);
    }
}
