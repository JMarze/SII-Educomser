<?php

use Illuminate\Database\Seeder;

class CronogramasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\LanzamientoCurso::class, 15)->create();
    }
}
