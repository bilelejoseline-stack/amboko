<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('localites', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // Nom de la localité
            $table->enum('type', ['Village', 'Quartier', 'Cité'])->default('Village');
            $table->string('chef_local')->nullable();
            $table->unsignedBigInteger('population')->nullable();
            $table->float('superficie_km2')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            // Relation avec la collectivité
            $table->foreignId('collectivite_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('localites');
    }
};
