<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SolutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('soluzione_tecnica')->insert([
            // iPhone Z (SA0980) - Schermo
            [
                'tipologia' => 'Calibrazione',
                'descrizione' => 'Calibrare il digitizer; aggiornare firmware touch.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'SA0980')->where('m.tipologia', 'Schermo')->value('m.id'),
            ],
            [
                'tipologia' => 'Sostituzione modulo',
                'descrizione' => 'Sostituire il modulo display completo (OLED + touch).',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'SA0980')->where('m.tipologia', 'Schermo')->value('m.id'),
            ],
            [
                'tipologia' => 'Isolamento interferenze',
                'descrizione' => 'Verifica schermi elettrostatici; serraggio flat e schermature.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'SA0980')->where('m.tipologia', 'Schermo')->value('m.id'),
            ],

            // iPhone Z (SA0980) - Batteria
            [
                'tipologia' => 'Ricalibrazione',
                'descrizione' => 'Scarica/ricarica completa e reset statistiche batteria.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'SA0980')->where('m.tipologia', 'Batteria')->value('m.id'),
            ],
            [
                'tipologia' => 'Sostituzione batteria',
                'descrizione' => 'Sostituire il pacco batteria con ricambio originale.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'SA0980')->where('m.tipologia', 'Batteria')->value('m.id'),
            ],
            [
                'tipologia' => 'Verifica caricatore',
                'descrizione' => 'Test carica rapida e cavo; aggiornare controller di carica.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'SA0980')->where('m.tipologia', 'Batteria')->value('m.id'),
            ],

            // Laptop Pro 15 (LP1500) - Tastiera
            [
                'tipologia' => 'Pulizia meccanica',
                'descrizione' => 'Rimozione keycaps, soffiaggio e pulizia contatti.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'LP1500')->where('m.tipologia', 'Tastiera')->value('m.id'),
            ],
            [
                'tipologia' => 'Sostituzione topcase',
                'descrizione' => 'Sostituire gruppo tastiera/palmrest difettoso.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'LP1500')->where('m.tipologia', 'Tastiera')->value('m.id'),
            ],
            [
                'tipologia' => 'Aggiornamento firmware',
                'descrizione' => 'Aggiornare firmware controller tastiera/EC.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'LP1500')->where('m.tipologia', 'Tastiera')->value('m.id'),
            ],

            // Laptop Pro 15 (LP1500) - Alimentazione
            [
                'tipologia' => 'Sostituzione alimentatore',
                'descrizione' => 'Test con PSU certificato e sostituzione se fuori specifica.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'LP1500')->where('m.tipologia', 'Alimentazione')->value('m.id'),
            ],
            [
                'tipologia' => 'Verifica DC-in',
                'descrizione' => 'Controllo jack di alimentazione e saldature su mainboard.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'LP1500')->where('m.tipologia', 'Alimentazione')->value('m.id'),
            ],
            [
                'tipologia' => 'Aggiornamento BIOS/EC',
                'descrizione' => 'Update BIOS e Embedded Controller alla versione stabile.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'LP1500')->where('m.tipologia', 'Alimentazione')->value('m.id'),
            ],

            // Smart TV Ultra (STU400) - Software
            [
                'tipologia' => 'Reset di fabbrica',
                'descrizione' => 'Ripristino impostazioni e reinstallazione app principali.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'STU400')->where('m.tipologia', 'Software')->value('m.id'),
            ],
            [
                'tipologia' => 'Aggiornamento firmware',
                'descrizione' => 'Installare ultimo firmware stabile compatibile con il modello.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'STU400')->where('m.tipologia', 'Software')->value('m.id'),
            ],

            // Smart TV Ultra (STU400) - Connettività
            [
                'tipologia' => 'Reset rete',
                'descrizione' => 'Dimenticare/reinserire Wi-Fi, impostare canale 5GHz fisso.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'STU400')->where('m.tipologia', 'Connettività')->value('m.id'),
            ],
            [
                'tipologia' => 'Update modulo Wi-Fi',
                'descrizione' => 'Aggiornare driver/modulo e disattivare quick start dallo standby.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'STU400')->where('m.tipologia', 'Connettività')->value('m.id'),
            ],

            // Auricolari Wireless (AW2024) - Audio
            [
                'tipologia' => 'Update firmware buds',
                'descrizione' => 'Aggiornamento via app; ribilanciamento canali L/R.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'AW2024')->where('m.tipologia', 'Audio')->value('m.id'),
            ],
            [
                'tipologia' => 'Adattamento gommini',
                'descrizione' => 'Sostituire tips e verificare corretta tenuta nel condotto uditivo.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'AW2024')->where('m.tipologia', 'Audio')->value('m.id'),
            ],

            // Auricolari Wireless (AW2024) - Ricarica
            [
                'tipologia' => 'Pulizia contatti',
                'descrizione' => 'Pulire pin della custodia e degli auricolari con isopropilico.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'AW2024')->where('m.tipologia', 'Ricarica')->value('m.id'),
            ],
            [
                'tipologia' => 'Sostituzione case',
                'descrizione' => 'Sostituire la custodia se non rileva correttamente la chiusura.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'AW2024')->where('m.tipologia', 'Ricarica')->value('m.id'),
            ],

            // Action Cam X2 (ACX2) - Impermeabilità
            [
                'tipologia' => 'Sostituzione guarnizioni',
                'descrizione' => 'Sostituire O-ring e applicare grasso siliconico.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'ACX2')->where('m.tipologia', 'Impermeabilità')->value('m.id'),
            ],
            [
                'tipologia' => 'Test pressione',
                'descrizione' => 'Eseguire test IPX in vasca a pressione controllata.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'ACX2')->where('m.tipologia', 'Impermeabilità')->value('m.id'),
            ],

            // Action Cam X2 (ACX2) - Memoria
            [
                'tipologia' => 'Formattazione exFAT',
                'descrizione' => 'Formattare microSD in exFAT; test velocità minima U3/V30.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'ACX2')->where('m.tipologia', 'Memoria')->value('m.id'),
            ],
            [
                'tipologia' => 'Update firmware cam',
                'descrizione' => 'Aggiornare firmware per migliorare buffer e I/O su 4K60.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'ACX2')->where('m.tipologia', 'Memoria')->value('m.id'),
            ],

            // Stampante Jet 3000 (JET3000) - Carta
            [
                'tipologia' => 'Regolazione rulli',
                'descrizione' => 'Regolare pressione rulli e usare carta 90–100 g/m².',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'JET3000')->where('m.tipologia', 'Carta')->value('m.id'),
            ],
            [
                'tipologia' => 'Pulizia percorso',
                'descrizione' => 'Pulire sensori e guide con kit manutenzione originale.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'JET3000')->where('m.tipologia', 'Carta')->value('m.id'),
            ],

            // Stampante Jet 3000 (JET3000) - Driver
            [
                'tipologia' => 'Reinstallazione driver',
                'descrizione' => 'Rimuovere e reinstallare driver; aggiornare pacchetto.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'JET3000')->where('m.tipologia', 'Driver')->value('m.id'),
            ],
            [
                'tipologia' => 'Reset rete stampante',
                'descrizione' => 'Ripristino impostazioni di rete e nuova configurazione SSID.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'JET3000')->where('m.tipologia', 'Driver')->value('m.id'),
            ],

            // Smartwatch Fit (SWF100) - Sensori
            [
                'tipologia' => 'Regolazione cinturino',
                'descrizione' => 'Stringere di un foro; pulire sensori ottici.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'SWF100')->where('m.tipologia', 'Sensori')->value('m.id'),
            ],
            [
                'tipologia' => 'Reset sensori',
                'descrizione' => 'Reset hardware e ricalibrazione tramite app dedicata.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'SWF100')->where('m.tipologia', 'Sensori')->value('m.id'),
            ],

            // Smartwatch Fit (SWF100) - Sync
            [
                'tipologia' => 'Re-pair Bluetooth',
                'descrizione' => 'Dissociare e riassociare; consentire tutte le notifiche.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'SWF100')->where('m.tipologia', 'Sync')->value('m.id'),
            ],
            [
                'tipologia' => 'Ottimizzazioni batteria',
                'descrizione' => 'Disattivare risparmio energetico dell’app sul telefono.',
                'id_malfunzionamento' => DB::table('malfunzionamento as m')
                    ->join('prodotto as p', 'p.id', '=', 'm.id_prodotto')
                    ->where('p.modello', 'SWF100')->where('m.tipologia', 'Sync')->value('m.id'),
            ],
        ]);
    }
}
