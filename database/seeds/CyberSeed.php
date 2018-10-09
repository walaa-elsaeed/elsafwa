<?php

use Illuminate\Database\Seeder;

class CyberSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Cyber::class,20)->create();
    }
}
