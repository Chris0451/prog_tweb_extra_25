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
        Schema::create('tecnico_assistenza', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_utente");
            $table->date("data_nascita");
            $table->string("nome_CA");
            $table->string("indirizzo_CA");
            $table->foreign("id_utente")->references('id')->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign(['nome_CA', 'indirizzo_CA'])->references(['nome', 'indirizzo'])->on('centro_assistenza')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tecnico_assistenza');
    }
};
