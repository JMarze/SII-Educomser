<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        //$this->call(AreasTableSeeder::class);
        //$this->call(DificultadesTableSeeder::class);
        //$this->call(CursosTableSeeder::class);
        //$this->call(CarrerasTableSeeder::class);
        //$this->call(TiposTableSeeder::class);
        //$this->call(GradosTableSeeder::class);
        //$this->call(ProfesionesTableSeeder::class);
        //$this->call(ExpedicionesTableSeeder::class);
        //$this->call(DocentesTableSeeder::class);
        //$this->call(CronogramasTableSeeder::class);
        //$this->call(AlumnosTableSeeder::class);
        //$this->call(ConceptosTableSeeder::class);
    }
}
