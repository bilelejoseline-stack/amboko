<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
      Schema::create('etude_civiles', function (Blueprint $table) {
          $table->id();

          $table->foreignId('militaire_id')->constrained()->onDelete('cascade');

          $table->string('intitule');               // Ex : Licence en Informatique de Gestion
          $table->string('etablissement');          // Ex : Université Libre de Kinshasa
          $table->string('lieu')->nullable();       // Ex : Kinshasa, RDC
          $table->string('diplome')->nullable();    // Ex : Licence, Master, Diplôme d’État
          $table->string('mention')->nullable();    // Ex : Distinction, Grande distinction

          $table->date('date_debut')->nullable();   // Début des études
          $table->date('date_fin')->nullable();     // Fin des études
          $table->year('annee_obtention')->nullable(); // Année d’obtention du diplôme

          $table->timestamps();
      });

    }

    public function down(): void
    {
        Schema::dropIfExists('etude_civiles');
    }
};
