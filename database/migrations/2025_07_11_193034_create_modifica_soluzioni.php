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
        Schema::create('modifica_soluzioni', function (Blueprint $table) {
            $table->unsignedBigInteger("id_staff_associato");
            $table->string("descrizione_soluzione");
            $table->string("tipologia_malfunzionamento");
            $table->unsignedBigInteger("id_prodotto_associato");
            
            $table->foreign("id_staff_associato")->references("id")->on("staff_tecnico")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign(["descrizione_soluzione","tipologia_malfunzionamento","id_prodotto_associato"], "fk_soluzioni")
                  ->references(["descrizione","tipologia_malfunzionamento","id_prodotto"])
                  ->on("soluzione_tecnica")->onUpdate("cascade")->onDelete("cascade");
            
            $table->primary(['id_staff_associato','descrizione_soluzione','id_prodotto_associato','tipologia_malfunzionamento']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modifica_soluzioni');
    }
};
