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
        Schema::create('centro_assistenza', function (Blueprint $table) {
            $table->id();
            $table->string("nome",100);
            $table->string("indirizzo",100);
            $table->string("foto",3000)->default('placeholder.jpg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centro_assistenza');
    }
};
