<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('soluzione_tecnica', function (Blueprint $table) {
            $table->id();
            $table->string('tipologia',100);
            $table->string('descrizione',1000);
            $table->unsignedBigInteger('id_malfunzionamento');
            
            $table->foreign('id_malfunzionamento')->references('id')->on('malfunzionamento')->onDelete('cascade')->onUpdate('cascade');
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
