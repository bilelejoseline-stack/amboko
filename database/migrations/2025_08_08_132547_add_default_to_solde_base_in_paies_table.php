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
             $table->decimal('solde_base', 10, 2)->default(0)->change();
         });
     }

     public function down()
     {
         Schema::table('paies', function (Blueprint $table) {
             $table->decimal('solde_base', 10, 2)->default(null)->change();
         });
     }

};
