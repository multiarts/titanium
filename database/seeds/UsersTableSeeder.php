<?php

use App\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();

        DB::table('role_user')->truncate();

        $adminRole = Role::where('slug', 'admin')->first();
        $managerRole = Role::where('slug', 'gerente')->first();
        $userRole = Role::where('slug', 'analista')->first();
        $docRole = Role::where('slug', 'documentacao')->first();

        $admin = User::create([
            'name' => 'João Mello',
            'username' => 'jmellodev',
            'email' => 'jmello@titoshop.com.br',
            'password' => 'joao.julia'
        ]);
        
        $manager = User::create([
            'name' => 'Gerente user',
            'username' => 'gerente',
            'email' => 'gerente@titoshop.com.br',
            'password' => 'password'
        ]);

        $user = User::create([
            'name' => 'Analista user',
            'username' => 'analista',
            'email' => 'analista@titoshop.com.br',
            'password' => 'password'
        ]);

        $doc = User::create([
            'name' => 'Documentacao user',
            'username' => 'documentacao',
            'email' => 'documentacao@titoshop.com.br',
            'password' => 'password'
        ]);

        $admin->roles()->attach($adminRole);
        $manager->roles()->attach($managerRole);
        $user->roles()->attach($userRole);
        $doc->roles()->attach($docRole);

    }
}
