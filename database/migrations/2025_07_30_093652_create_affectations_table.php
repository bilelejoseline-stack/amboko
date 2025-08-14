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
        Schema::create('affectations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('militaire_id')->constrained()->onDelete('cascade');
            $table->string('poste');               // Intitulé du poste ou fonction
            $table->string('unite');               // Unité ou service d’affectation
            $table->date('date_debut');            // Date de début d’affectation
            $table->date('date_fin')->nullable();  // Date de fin (nullable si en cours)
            $table->text('commentaires')->nullable(); // Observations supplémentaires
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affectations');
    }
};
