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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');              // Nom du membre
            $table->string('slug')->unique();   // Identifiant URL friendly, unique
            $table->string('role');              // Rôle dans l'équipe
            $table->string('avatar')->nullable(); // Chemin ou URL de l'avatar
            $table->text('bio')->nullable();    // Biographie optionnelle
            $table->boolean('active')->default(true); // Statut actif par défaut
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
