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
            $table->string("nome");
            $table->string("indirizzo");
            $table->string("foto");
            $table->primary(['nome','indirizzo']);
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
