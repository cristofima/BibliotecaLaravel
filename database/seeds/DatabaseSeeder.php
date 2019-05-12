<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        $roleAdmin = Role::updateOrCreate(['name' => "admin"], [
            'name' => "admin",
            'display_name' => 'Administrador',
        ]);

        Role::updateOrCreate(['name' => "client"], [
            'name' => "client",
            'display_name' => 'Cliente',
        ]);

        // Admin User
        $data = [
            'name' => "Admin",
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret'),
            'email_verified_at' => date('Y-m-d H:i:s'),
        ];
        $user = User::updateOrCreate(['email' => 'admin@gmail.com'], $data);
        $user->roles()->sync([$roleAdmin->id]);
    }
}
