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
        Schema::create('assegnazione_prodotto', function (Blueprint $table) {
            $table->unsignedBigInteger("id_staff_associato");
            $table->unsignedBigInteger("id_prodotto");
            $table->foreign("id_prodotto")->references("id")->on("prodotto")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("id_staff_associato")->references("id")->on("staff_tecnico")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
            $table->primary(["id_prodotto","id_staff_associato"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accesso_prodotto');
    }
};
