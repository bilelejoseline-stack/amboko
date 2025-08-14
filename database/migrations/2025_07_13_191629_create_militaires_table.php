<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('militaires', function (Blueprint $table) {
            $table->id();

            // Matricule exact 12 caractères, unique
            $table->string('matricule', 12)->unique();

            $table->string('nom');
            $table->string('postnom');
            $table->string('prenom');
            $table->string('slug')->unique();

            // Relation utilisateur (créateur)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Relation grade
            $table->foreignId('grade_id')->constrained()->onDelete('cascade');

            $table->string('fonction');
            $table->string('unite');

            $table->date('date_incorporation');
            $table->string('lieu_incorporation');

            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->enum('sexe', ['M', 'F'])->nullable();
            $table->string('etat_civil')->nullable();
            $table->string('epouse')->nullable();

            $table->string('papa');
            $table->string('maman');

            // Relations géographiques
            $table->foreignId('province_id')->nullable()->constrained('provinces')->nullOnDelete();
            $table->foreignId('district_id')->nullable()->constrained('districts')->nullOnDelete();
            $table->foreignId('territoire_id')->nullable()->constrained('territoires')->nullOnDelete();
            $table->foreignId('collectivite_id')->nullable()->constrained('collectivites')->nullOnDelete();
            $table->foreignId('localite_id')->nullable()->constrained('localites')->nullOnDelete();

            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('territoire')->nullable();
            $table->string('collectivite')->nullable();
            $table->string('localite')->nullable();

            $table->string('statut')->nullable();
            $table->string('code', 10)->unique();

            $table->string('adresse');
            $table->string('telephone');
            $table->string('avatar')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('militaires');
    }
};
