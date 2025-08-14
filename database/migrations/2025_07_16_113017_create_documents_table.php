<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Exécute la migration.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            // Liaison avec l'utilisateur qui a créé le document
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Référence administrative unique
            $table->string('reference', 50)->unique();
            // Slug unique pour identification rapide et URLs propres
            $table->string('slug')->unique();

            $table->string('objet');
            $table->text('description')->nullable();

            // Classification du type de document
            $table->enum('type_document', [
                'Lettre',
                'Rapport',
                'Note',
                'Décision',
                'Ordre de Mission',
                'Instruction',
                'Message',
                'Mémo',
                'Télégramme',
                'Ordonnance',
                'Sitrep',
                'Fiche',
                'Requête',
                'Autre',
            ]);


            // Dates clés du cycle de vie du document
            $table->date('date_document');
            $table->date('date_reception')->nullable();
            $table->date('date_sortie')->nullable();

            // Provenance & destinataire
            $table->string('provenance')->nullable();
            $table->string('destinataire')->nullable();

            // Suivi de traitement
            $table->enum('statut', ['Enregistré', 'En attente', 'Traité', 'Classé'])->default('Enregistré');
            $table->enum('priorite', ['Basse', 'Normale', 'Haute', 'Urgente'])->default('Normale');

            // Mentions supplémentaires et remarques
            $table->text('mention')->nullable();
            $table->text('observations')->nullable();

            // Lien vers une pièce jointe (scan, PDF, image, etc.)
            $table->string('fichier')->nullable();


            // Horodatage automatique Laravel
            $table->timestamps();
        });
    }

    /**
     * Annule la migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
