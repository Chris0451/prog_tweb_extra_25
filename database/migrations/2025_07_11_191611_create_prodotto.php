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
        Schema::create('prodotto', function (Blueprint $table) {
            $table->id();
            $table->string('descrizione',1000);
            $table->string('note_tecniche',1000);
            $table->string('mod_installazione',1000);
            $table->string('modello', 100);
            $table->string('marca',100);
            $table->string('foto', 500);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodotto');
    }
};
