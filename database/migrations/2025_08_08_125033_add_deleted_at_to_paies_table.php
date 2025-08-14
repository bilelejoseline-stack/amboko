<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
     {
         Schema::table('paies', function (Blueprint $table) {
             $table->softDeletes(); // ajoute la colonne deleted_at nullable timestamp
         });
     }

     public function down()
     {
         Schema::table('paies', function (Blueprint $table) {
             $table->dropSoftDeletes(); // supprime la colonne deleted_at
         });
     }

};
