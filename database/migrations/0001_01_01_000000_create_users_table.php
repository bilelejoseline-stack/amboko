<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Identité basique de l'utilisateur
            $table->string('name'); // Nom complet (ex: Jean Dupont)
            $table->string('username')->unique()->nullable()->index(); // Nom d'utilisateur unique
            $table->string('email')->unique()->index(); // Email unique
            $table->timestamp('email_verified_at')->nullable();

            // Authentification
            $table->string('password');
            $table->string('code')->nullable(); // Code d'accès hashé (optionnel)

            $table->rememberToken();

            // Rôles et statuts
            $table->enum('role', ['super_admin', 'admin', 'superviseur', 'agent', 'user'])->default('user');
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });

        // Table de jetons de réinitialisation de mot de passe (optionnelle si tu utilises le système Laravel par défaut)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Table des sessions utilisateur (optionnelle, selon ta configuration de session)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
