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
        Schema::create('comdts', function (Blueprint $table) {
          $table->id();
          $table->string('titre');
          $table->string('image')->nullable();
          $table->string('slug')->unique();
          $table->year('debut_annee');
          $table->year('fin_annee')->nullable();
          $table->text('citation')->nullable();
          $table->json('contenus')->nullable(); // On stockera les répétables ici
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comdts');
    }
};
