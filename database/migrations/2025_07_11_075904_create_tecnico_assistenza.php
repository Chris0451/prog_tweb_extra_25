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
            $table->string("specializzazione");
            $table->date("data_nascita");
            $table->unsignedBigInteger("id_centro_assistenza")->nullable();
            $table->foreign("id_utente")->references('id')->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("id_centro_assistenza")->references('id')->on('centro_assistenza')->onDelete('set null')->onUpdate('cascade');
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
