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
        Schema::create('modifica_malfunzionamenti', function (Blueprint $table) {
            $table->unsignedBigInteger("id_staff_associato");
            $table->unsignedBigInteger("id_prodotto_associato");
            $table->string("tipologia_malfunzionamento");
            
            $table->foreign("id_staff_associato")->references("id")
                  ->on("staff_tecnico")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign(["tipologia_malfunzionamento","id_prodotto_associato"], "fk_malfunzionamenti")
                  ->references(["tipologia","id_prodotto"])
                  ->on("malfunzionamento")->onDelete("cascade")->onUpdate("cascade");
            
            $table->primary(['id_staff_associato','id_prodotto_associato','tipologia_malfunzionamento']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modifica_malfunzionamenti');
    }
};
