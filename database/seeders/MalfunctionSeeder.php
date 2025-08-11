<?php

namespace Database\Seeders;

use App\Models\Resources\Prodotto;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MalfunctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('malfunzionamento')->insert([
            // iPhone Z (SA0980)
            [
                'tipologia' => 'Schermo',
                'descrizione' => 'Aloni sul display OLED e tocchi fantasma a freddo.',
                'id_prodotto' => Prodotto::where('modello', 'SA0980')->value('id'),
            ],
            [
                'tipologia' => 'Batteria',
                'descrizione' => 'Scarica rapida sotto il 20% e surriscaldamento in carica rapida.',
                'id_prodotto' => Prodotto::where('modello', 'SA0980')->value('id'),
            ],

            // Laptop Pro 15 (LP1500)
            [
                'tipologia' => 'Tastiera',
                'descrizione' => 'Tasti che si incastrano, in particolare spazio e shift.',
                'id_prodotto' => Prodotto::where('modello', 'LP1500')->value('id'),
            ],
            [
                'tipologia' => 'Alimentazione',
                'descrizione' => 'Alimentatore intermittente: il laptop passa a batteria casualmente.',
                'id_prodotto' => Prodotto::where('modello', 'LP1500')->value('id'),
            ],

            // Smart TV Ultra (STU400)
            [
                'tipologia' => 'Software',
                'descrizione' => 'Riavvii spontanei durante lo streaming 4K HDR.',
                'id_prodotto' => Prodotto::where('modello', 'STU400')->value('id'),
            ],
            [
                'tipologia' => 'Connettività',
                'descrizione' => 'Perdita del Wi-Fi dopo standby prolungato.',
                'id_prodotto' => Prodotto::where('modello', 'STU400')->value('id'),
            ],

            // Auricolari Wireless (AW2024)
            [
                'tipologia' => 'Audio',
                'descrizione' => 'Fruscio sull’auricolare sinistro a volume basso.',
                'id_prodotto' => Prodotto::where('modello', 'AW2024')->value('id'),
            ],
            [
                'tipologia' => 'Ricarica',
                'descrizione' => 'Custodia non rileva la chiusura: LED resta acceso.',
                'id_prodotto' => Prodotto::where('modello', 'AW2024')->value('id'),
            ],

            // Action Cam X2 (ACX2)
            [
                'tipologia' => 'Impermeabilità',
                'descrizione' => 'Condensa interna dopo immersioni ripetute.',
                'id_prodotto' => Prodotto::where('modello', 'ACX2')->value('id'),
            ],
            [
                'tipologia' => 'Memoria',
                'descrizione' => 'Errori di scrittura con microSD UHS-I in modalità 4K60.',
                'id_prodotto' => Prodotto::where('modello', 'ACX2')->value('id'),
            ],

            // Stampante Jet 3000 (JET3000)
            [
                'tipologia' => 'Carta',
                'descrizione' => 'Presa carta doppia con fogli riciclati 80 g/m².',
                'id_prodotto' => Prodotto::where('modello', 'JET3000')->value('id'),
            ],
            [
                'tipologia' => 'Driver',
                'descrizione' => 'Driver Wi-Fi non rileva la stampante dopo cambio SSID.',
                'id_prodotto' => Prodotto::where('modello', 'JET3000')->value('id'),
            ],

            // Smartwatch Fit (SWF100)
            [
                'tipologia' => 'Sensori',
                'descrizione' => 'Letture del battito irregolari durante corsa intervallata.',
                'id_prodotto' => Prodotto::where('modello', 'SWF100')->value('id'),
            ],
            [
                'tipologia' => 'Sync',
                'descrizione' => 'Sincronizzazione notifiche ritardata con Android 14.',
                'id_prodotto' => Prodotto::where('modello', 'SWF100')->value('id'),
            ],
        ]);
    }
}
