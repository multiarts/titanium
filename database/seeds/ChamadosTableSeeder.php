<?php

use App\Models\Chamados;
use Illuminate\Database\Seeder;

class ChamadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Chamados::class, 20)->create();
    }
}
