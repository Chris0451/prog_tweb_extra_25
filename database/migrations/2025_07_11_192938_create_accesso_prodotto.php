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
        Schema::create('accesso_prodotto', function (Blueprint $table) {
            $table->unsignedBigInteger("id_prodotto");
            $table->unsignedBigInteger("tecnico_associato");
            $table->foreign("id_prodotto")->references("id")->on("prodotto")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("tecnico_associato")->references("id")->on("tecnico_assistenza")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
            $table->primary(["id_prodotto","tecnico_associato"]);
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
