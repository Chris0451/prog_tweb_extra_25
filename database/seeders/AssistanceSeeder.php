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
                'nome' => 'Phone Store',
                'indirizzo' => 'Via Roma, 30 - Falconara - Ancona',
                'foto' => 'centro_1.jpg'
            ],
            [
                'nome' => 'Tech Support Informatica',
                'indirizzo' => 'Viale della Vittoria, 12 - Ancona',
                'foto' => 'centro_2.jpg'
            ],
            [
                'nome' => 'CAM Jesi',
                'indirizzo' => 'Piazza Federico II, 5 - Jesi - Ancona',
                'foto' => 'centro_3.jpg'
            ],
            [
                'nome' => 'Centro Riparazioni Senigallia',
                'indirizzo' => 'Corso 2 Giugno, 45 - Senigallia - Ancona',
                'foto' => 'centro_4.jpg'
            ],
            [
                'nome' => 'Computer Mania Marche',
                'indirizzo' => 'Via Dante Alighieri, 18 - Osimo - Ancona',
                'foto' => 'centro_5.jpg'
            ],
        ]);
    }
}
