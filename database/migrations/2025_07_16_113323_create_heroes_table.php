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
      Schema::create('heroes', function (Blueprint $table) {
          $table->id();
          $table->string('image'); // chemin de l'image (ex: heroes/slider1.jpg)
          $table->string('title'); // titre principal à afficher avec l'effet machine à écrire
          $table->string('subtitle')->nullable(); // sous-titre
          $table->text('description')->nullable(); // description
          $table->boolean('active')->default(true);
          $table->timestamps();
      });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};
