<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::truncate();

        Role::create(['name' => 'Administrador', 'slug' => 'admin']);
        Role::create(['name' => 'Analista', 'slug' => 'analista']);
        Role::create(['name' => 'Gerente', 'slug' => 'gerente']);
        Role::create(['name' => 'Documentação', 'slug' => 'documentacao']);
    }
}
