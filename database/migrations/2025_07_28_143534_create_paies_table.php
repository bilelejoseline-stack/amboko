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
      Schema::create('paies', function (Blueprint $table) {
          $table->id();
          $table->foreignId('militaire_id')->constrained()->onDelete('cascade');
          $table->decimal('solde_base', 10, 2); // Salaire brut selon grade
          $table->decimal('prime_combat', 10, 2)->default(0);
          $table->decimal('prime_risque', 10, 2)->default(0);
          $table->decimal('autres_primes', 10, 2)->default(0);
          $table->decimal('retenue', 10, 2)->default(0); // Assurance, pension, etc.
          $table->decimal('net_a_payer', 10, 2); // Calculé automatiquement
          $table->string('mois'); // Exemple : "07"
          $table->year('annee');
          $table->timestamps();
      });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paies');
    }
};
