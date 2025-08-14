<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sante_militaires', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->string('sous_titre')->nullable();   // ➕ Sous-titre unique
            $table->text('description')->nullable();    // ➕ Description unique
            $table->json('contenus')->nullable();       // ➕ Contenus multiples JSON
            $table->string('image')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sante_militaires');
    }
};
