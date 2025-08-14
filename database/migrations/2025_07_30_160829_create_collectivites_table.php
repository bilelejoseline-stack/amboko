<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collectivites', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // Nom de la collectivité
            $table->enum('type', ['chefferie', 'secteur']); // Type de collectivité
            $table->unsignedBigInteger('territoire_id'); // FK vers territoire
            $table->string('chef_lieu')->nullable(); // Chef-lieu de la collectivité
            $table->unsignedBigInteger('population')->nullable(); // Population estimée
            $table->float('superficie_km2')->nullable(); // Superficie en km2
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->timestamps();

            // Clé étrangère vers territoire
            $table->foreign('territoire_id')->references('id')->on('territoires')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collectivites');
    }
};
