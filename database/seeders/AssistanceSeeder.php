<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssistanceSeeder extends Seeder
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
                'foto' => 'images/placeholder.jpg'
            ],
            [
                'nome' => 'Tech Support Ancona',
                'indirizzo' => 'Viale della Vittoria, 12 - Ancona',
                'foto' => 'images/placeholder.jpg'
            ],
            [
                'nome' => 'Servizi Tecnici Jesi',
                'indirizzo' => 'Piazza Federico II, 5 - Jesi - Ancona',
                'foto' => 'images/placeholder.jpg'
            ],
            [
                'nome' => 'Centro Riparazioni Senigallia',
                'indirizzo' => 'Corso 2 Giugno, 45 - Senigallia - Ancona',
                'foto' => 'images/placeholder.jpg'
            ],
            [
                'nome' => 'Assistenza Marche Sud',
                'indirizzo' => 'Via Dante Alighieri, 18 - Osimo - Ancona',
                'foto' => 'images/placeholder.jpg'
            ],
        ]);
    }
}
