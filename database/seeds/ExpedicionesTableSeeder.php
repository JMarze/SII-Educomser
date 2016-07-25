<?php

use Illuminate\Database\Seeder;

class ExpedicionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('expediciones')->insert([
            'codigo' => 'LP',
            'ciudad' => 'La Paz',
        ]);
        DB::table('expediciones')->insert([
            'codigo' => 'OR',
            'ciudad' => 'Oruro',
        ]);
        DB::table('expediciones')->insert([
            'codigo' => 'PT',
            'ciudad' => 'Potosi',
        ]);
        DB::table('expediciones')->insert([
            'codigo' => 'CB',
            'ciudad' => 'Cochabamba',
        ]);
        DB::table('expediciones')->insert([
            'codigo' => 'SC',
            'ciudad' => 'Santa Cruz',
        ]);
        DB::table('expediciones')->insert([
            'codigo' => 'BN',
            'ciudad' => 'Beni',
        ]);
        DB::table('expediciones')->insert([
            'codigo' => 'PA',
            'ciudad' => 'Pando',
        ]);
        DB::table('expediciones')->insert([
            'codigo' => 'TJ',
            'ciudad' => 'Tarija',
        ]);
        DB::table('expediciones')->insert([
            'codigo' => 'CH',
            'ciudad' => 'Chuquisaca',
        ]);
    }
}
