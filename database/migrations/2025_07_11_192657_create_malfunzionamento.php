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
        Schema::create('malfunzionamento', function (Blueprint $table) {
            $table->string('descrizione', 1000);
            $table->string('tipologia');
            $table->unsignedBigInteger('id_prodotto');
            $table->foreign('id_prodotto')->references('id')->on('prodotto')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['tipologia', 'id_prodotto']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('malfunzionamento');
    }
};
