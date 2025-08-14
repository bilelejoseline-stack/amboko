<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pays_id')->index(); // Clé étrangère vers le pays
            $table->string('nom'); // Exemple : Kinshasa
            $table->string('chef_lieu')->nullable(); // Exemple : Kinshasa pour Kinshasa
            $table->string('region')->nullable(); // Exemple : Grand Équateur
            $table->unsignedBigInteger('population')->nullable(); // En habitants
            $table->unsignedBigInteger('superficie_km2')->nullable(); // En km²

            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            $table->timestamps();

            // Définition de la contrainte de clé étrangère
            $table->foreign('pays_id')->references('id')->on('pays')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provinces');
    }
};
