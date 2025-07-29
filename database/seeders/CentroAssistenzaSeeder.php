<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CentroAssistenzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('centro_assistenza')->insert([
            [
                'nome' => 'Centro Assistenza Falconara',
                'indirizzo' => 'Via Roma, 30 - Falconara - Ancona',
                'foto' => '...'
            ],
            [
                'nome' => 'Tech Support Ancona',
                'indirizzo' => 'Viale della Vittoria, 12 - Ancona',
                'foto' => '...'
            ],
            [
                'nome' => 'Servizi Tecnici Jesi',
                'indirizzo' => 'Piazza Federico II, 5 - Jesi - Ancona',
                'foto' => '...'
            ],
            [
                'nome' => 'Centro Riparazioni Senigallia',
                'indirizzo' => 'Corso 2 Giugno, 45 - Senigallia - Ancona',
                'foto' => '...'
            ],
            [
                'nome' => 'Assistenza Marche Sud',
                'indirizzo' => 'Via Dante Alighieri, 18 - Osimo - Ancona',
                'foto' => '...'
            ],
        ]);
    }
}
