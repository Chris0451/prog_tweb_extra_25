<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prodotto')->insert([
            [
                'nome' => 'Iphone Z',
                'descrizione' => 'Smartphone di ultima generazione con display OLED.',
                'tecniche_uso' => 'Manuale incluso. Uso intuitivo.',
                'mod_installazione' => 'Inserire SIM, avviare, seguire le istruzioni.',
                'modello' => 'SA0980',
                'marca' => 'Phony',
                'foto' => 'iphone.jpg'
            ],
            [
                'nome' => 'Laptop Pro 15',
                'descrizione' => 'Notebook ad alte prestazioni per professionisti.',
                'tecniche_uso' => 'Guida rapida nel packaging.',
                'mod_installazione' => 'Collegare l\'alimentatore, accendere.',
                'modello' => 'LP1500',
                'marca' => 'Pear',
                'foto' => 'laptop.jpg'
            ],
            [
                'nome' => 'Smart TV Ultra',
                'descrizione' => 'Televisore 4K con funzioni smart integrate.',
                'tecniche_uso' => 'Consultare il manuale digitale.',
                'mod_installazione' => 'Fissare al muro, collegare alimentazione.',
                'modello' => 'STU400',
                'marca' => 'VisionTech',
                'foto' => 'tv.jpg'//'images/placeholder.jpg'
            ],
            [
                'nome' => 'Auricolari Wireless',
                'descrizione' => 'Auricolari bluetooth con cancellazione rumore.',
                'tecniche_uso' => 'Manuale online disponibile.',
                'mod_installazione' => 'Associare via bluetooth al dispositivo.',
                'modello' => 'AW2024',
                'marca' => 'SoundBeat',
                'foto' => 'earbuds.jpg'//'images/placeholder.jpg'
            ],
            [
                'nome' => 'Action Cam X2',
                'descrizione' => 'Videocamera sportiva impermeabile.',
                'tecniche_uso' => 'Consigliata l\'app per editing.',
                'mod_installazione' => 'Montare su supporto, inserire microSD.',
                'modello' => 'ACX2',
                'marca' => 'GoMovie',
                'foto' => 'actioncam.jpg'//'images/placeholder.jpg'
            ],
            [
                'nome' => 'Stampante Jet 3000',
                'descrizione' => 'Stampante multifunzione wireless.',
                'tecniche_uso' => 'Vedi guida rapida per l’installazione driver.',
                'mod_installazione' => 'Collegare Wi-Fi, installare software.',
                'modello' => 'JET3000',
                'marca' => 'PrintMaster',
                'foto' => 'printer.jpg'//'images/placeholder.jpg'
            ],
            [
                'nome' => 'Smartwatch Fit',
                'descrizione' => 'Orologio fitness con monitoraggio battito.',
                'tecniche_uso' => 'App dedicata per sincronizzazione dati.',
                'mod_installazione' => 'Indossare, associare a smartphone.',
                'modello' => 'SWF100',
                'marca' => 'FitNow',
                'foto' => 'smartwatch.jpg'//'images/placeholder.jpg'
            ],
        ]);
    }
}
