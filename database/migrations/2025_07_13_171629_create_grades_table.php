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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('nom_grade')->unique(); // Nom complet du grade (ex: Capitaine)
            $table->string('abreviation')->nullable(); // Abréviation (ex: Cpt)
            $table->unsignedTinyInteger('niveau_hierarchique')->default(1); // Niveau hiérarchique
            $table->decimal('solde_base', 12, 2)->default(0); // Solde de base
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
