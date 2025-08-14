<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
      Schema::create('etude_militaires', function (Blueprint $table) {
          $table->id();
          $table->foreignId('militaire_id')->constrained()->onDelete('cascade'); // Lien avec le militaire

          $table->string('nom_etude');              // Ex : Formation commando, École d’état-major
          $table->string('institution')->nullable(); // Centre ou école militaire (ex: Kitona, Ndolo, AMAT)
          $table->string('pays')->nullable();        // Ex : RDC, Angola, France
          $table->date('date_debut')->nullable();    // Date de début de la formation
          $table->date('date_fin')->nullable();      // Date de fin de la formation
          $table->year('annee_obtention')->nullable(); // Année d’obtention d’un brevet, diplôme ou certificat
          $table->string('titre')->nullable();       // Grade ou certificat obtenu (ex: Certificat de pilote drone)
          $table->text('description')->nullable();   // Spécialités ou détails
          $table->timestamps();
      });

    }

    public function down(): void
    {
        Schema::dropIfExists('etude_militaires');
    }
};
