<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // 🔧 Création des rôles
        $roles = ['super-admin', 'admin', 'agent'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // 👑 Attribution du rôle super-admin à l'utilisateur avec ID 1
        $superAdmin = User::find(1);
        if ($superAdmin) {
            $superAdmin->assignRole('super-admin');
        }
    }
}
