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
        Schema::create('specialites', function (Blueprint $table) {
            $table->id();
            $table->string('nom_specialite')->unique(); // Nom de la spécialité
            $table->text('description')->nullable(); // Description optionnelle
            $table->timestamps();
        });

        // Table pivot si un militaire peut avoir plusieurs spécialités
        Schema::create('militaire_specialite', function (Blueprint $table) {
            $table->id();
            $table->foreignId('militaire_id')->constrained()->onDelete('cascade');
            $table->foreignId('specialite_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('militaire_specialite');
        Schema::dropIfExists('specialites');
    }
};
