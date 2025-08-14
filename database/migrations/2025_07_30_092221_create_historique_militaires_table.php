<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historique_militaires', function (Blueprint $table) {
            $table->id();

            $table->foreignId('militaire_id')->constrained()->onDelete('cascade');

            $table->string('type_evenement'); // Ex: Affectation, Décoration, Mission, Sanction
            $table->text('description'); // Détail de l’événement
            $table->date('date_evenement')->nullable();
            $table->string('lieu')->nullable(); // Où cela s’est passé
            $table->string('reference_document')->nullable(); // N° de document, ordre, décision, etc.

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historique_militaires');
    }
};
