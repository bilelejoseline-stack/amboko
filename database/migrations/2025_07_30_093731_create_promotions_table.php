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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('militaire_id')->constrained()->onDelete('cascade');
            $table->foreignId('grade_id')->constrained()->onDelete('restrict'); // Le grade attribué

            $table->date('date_promotion'); // Date officielle de la promotion

            $table->string('decision_numero')->nullable(); // Référence administrative de la décision
            $table->string('commentaire')->nullable(); // Observations ou notes spécifiques

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
