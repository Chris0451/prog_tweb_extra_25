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
        Schema::create('soluzione_tecnica', function (Blueprint $table) {
            $table->string('descrizione');
            $table->string('tipologia_malfunzionamento');
            $table->unsignedBigInteger('id_prodotto');
            
            $table->foreign('id_prodotto')->references('id')->on('prodotto')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tipologia_malfunzionamento')->references('tipologia')->on('malfunzionamento')->onDelete('cascade')->onUpdate('cascade');
            
            $table->primary(['descrizione','tipologia_malfunzionamento', 'id_prodotto']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soluzione_tecnica');
    }
};
