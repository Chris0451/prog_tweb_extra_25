<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TecnicoAssistenzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tecnico_assistenza')->insert([
            ['id_utente' => '1', 'specializzazione' => 'Tecnico informatico', 'data_nascita' => '1989-01-21', 'id_centro_assistenza' => '1' ]
        ]);
    }
}
