<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->id();

            $table->string('nom'); // Nom complet
            $table->string('nom_court')->nullable(); // Nom abrégé (ex: RDC)
            $table->string('capitale')->nullable();
            $table->string('continent')->nullable();
            $table->string('region')->nullable();

            $table->char('code_iso2', 2)->unique(); // Ex: CD
            $table->char('code_iso3', 3)->unique(); // Ex: COD

            $table->string('indicatif_telephonique')->nullable(); // Ex: +243
            $table->string('monnaie')->nullable(); // Franc Congolais
            $table->string('code_monnaie', 3)->nullable(); // CDF

            $table->string('fuseau_horaire')->nullable(); // UTC+2
            $table->string('domaine_internet')->nullable(); // .cd
            $table->string('drapeau_url')->nullable(); // URL du drapeau

            $table->string('langue_officielle')->nullable(); // Français

            $table->unsignedBigInteger('population')->nullable();
            $table->unsignedBigInteger('superficie_km2')->nullable();

            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pays');
    }
};
