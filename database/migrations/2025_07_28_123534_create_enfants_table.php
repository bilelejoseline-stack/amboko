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
      Schema::create('enfants', function (Blueprint $table) {
          $table->id();
          $table->foreignId('militaire_id')->constrained()->onDelete('cascade');
          $table->string('nom');
          $table->string('postnom');
          $table->string('prenom');
          $table->date('date_naissance');
          $table->string('lieu_naissance');
          $table->enum('sexe', ['M', 'F'])->nullable();
          $table->timestamps();
      });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enfants');
    }
};
