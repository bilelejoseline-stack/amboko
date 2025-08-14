<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Militaire;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Superadmin officiel unique, création protégée
        if (!User::where('email', 'superadmin@fardc.cd')->exists()) {
            User::create([
                'name' => 'Superadmin FARDC',
                'username' => 'superfardc',
                'email' => 'superadmin@fardc.cd',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // CHANGE en prod !
                'code' => Hash::make('supersecretcode'),
                'role' => 'super_admin',
                'is_active' => true,
                'remember_token' => Str::random(10),
            ]);
            $this->command->info('✅ Super_admin FARDC créé');
        } else {
            $this->command->warn('⚠️ Superadmin déjà existant');
        }

        // Création des administrateurs
        User::factory(2)->create(['role' => 'admin'])->each(function ($user) {
            Militaire::factory()->create(['user_id' => $user->id]);
        });
        $this->command->info('👮‍♂️ 2 Administrateurs créés avec militaires associés');

        // Création des agents
        User::factory(5)->create(['role' => 'agent'])->each(function ($user) {
            Militaire::factory()->create(['user_id' => $user->id]);
        });
        $this->command->info('🪖 5 Agents créés avec militaires associés');

        // Création d’utilisateurs simples
        User::factory(10)->create(['role' => 'user'])->each(function ($user) {
            Militaire::factory()->create(['user_id' => $user->id]);
        });
        $this->command->info('👤 10 Utilisateurs simples créés avec militaires associés');
    }
}
