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
      Schema::create('cemgs', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('militaire_id');
          $table->string('name');
          $table->unsignedBigInteger('role_id')->unique(); // Un rôle ne peut être pris qu’une seule fois
          $table->text('description')->nullable();
          $table->boolean('active')->default(true);
          $table->timestamps();

          $table->foreign('role_id')->references('id')->on('role_cemgs')->onDelete('cascade');

          // Optionnel : lien avec table militaires
          // $table->foreign('militaire_id')->references('id')->on('militaires')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cemgs');
    }
};
