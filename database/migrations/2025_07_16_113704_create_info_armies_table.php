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
        Schema::create('info_armies', function (Blueprint $table) {
            $table->id();

            $table->string('title'); // Ex: "Alerte", "Sport", "Nécrologie"
            $table->text('message'); // Message à afficher
            $table->boolean('active')->default(true); // Message activé ou désactivé
            $table->integer('priority')->default(0); // Pour l’ordre d’affichage (plus bas = prioritaire)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_armies');
    }
};
