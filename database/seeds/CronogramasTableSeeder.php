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
        factory(App\Cronograma::class, 15)->create();
    }
}
