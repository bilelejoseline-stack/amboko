<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();
            $table->json('subtitles')->nullable();     // Tableaux de sous-titres
            $table->json('descriptions')->nullable();  // Tableaux de descriptions
            $table->string('image')->nullable();
            $table->string('video')->nullable();       // Vidéo locale (upload)
            $table->boolean('active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
