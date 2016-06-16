<?php

use Illuminate\Database\Seeder;

class GradosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grados')->insert([
            'descripcion' => 'Técnico',
            'abreviatura' => 'Téc.',
        ]);
        DB::table('grados')->insert([
            'descripcion' => 'Ingeniero',
            'abreviatura' => 'Ing.',
        ]);
        DB::table('grados')->insert([
            'descripcion' => 'Licenciado',
            'abreviatura' => 'Lic.',
        ]);
    }
}
