<?php

use App\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        DB::table('role_user')->truncate();

        $adminRole = Role::where('name', 'admin')->first();
        $managerRole = Role::where('name', 'gerente')->first();
        $userRole = Role::where('name', 'analista')->first();

        $admin = User::create([
            'name' => 'Silvio Manoel',
            'username' => 'bigboss',
            'email' => 'bigboss@titanium.com.br',
            'password' => 'password'
        ]);
        
        $manager = User::create([
            'name' => 'Manager user',
            'username' => 'manager',
            'email' => 'manager@titanium.com.br',
            'password' => 'password'
        ]);
        $user = User::create([
            'name' => 'Generic user',
            'username' => 'generic',
            'email' => 'generic@titanium.com.br',
            'password' => 'password'
        ]);

        $admin->roles()->attach($adminRole);
        $manager->roles()->attach($managerRole);
        $user->roles()->attach($userRole);

    }
}
