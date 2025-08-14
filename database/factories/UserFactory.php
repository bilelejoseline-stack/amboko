<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Militaire;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        $roles = ['user', 'agent', 'admin', 'super_admin', 'superviseur'];

        return [
            'name' => $this->faker->name(),             // Nom complet pour l’authentification
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),       // À changer impérativement en prod
            'code' => Hash::make('mon-code-secret'),
            'role' => $this->faker->randomElement($roles),
            'is_active' => true,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Crée un utilisateur avec un militaire lié.
     */
    public function withMilitaire()
    {
        return $this->afterCreating(function (User $user) {
            if (!$user->militaire) {
                $militaire = Militaire::factory()->create(['user_id' => $user->id]);
                $user->militaire()->save($militaire);
            }
        });
    }
}
