<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssegnazioneProdottoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('assegnazione_prodotto')->insert([
            ['id_staff_associato' => '1', 'id_prodotto' => '1'],
            ['id_staff_associato' => '1', 'id_prodotto' => '2'],
            ['id_staff_associato' => '1', 'id_prodotto' => '3'],
            ['id_staff_associato' => '1', 'id_prodotto' => '4'],
            ['id_staff_associato' => '1', 'id_prodotto' => '5']
        ]);
    }
}
