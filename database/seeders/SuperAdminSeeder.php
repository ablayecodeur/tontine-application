<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@tontine.com',
            'phone' => '0000000000',
            'role' => 'super_admin',
            'password' => bcrypt('password') // Changez ce mot de passe en production
        ]);
    }
}
