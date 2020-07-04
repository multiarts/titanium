<?php

use App\Models\Tecnico;
use Illuminate\Database\Seeder;

class TecnicosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tecnico::class, 20)->create();
    }
}
