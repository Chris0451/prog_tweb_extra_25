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
            ['nome' => 'Iphone Z',
            'descrizione' => 'Descrizione prodotto X',
             'tecniche_uso' => 'Lorem Ipsum',
             'mod_installazione' => 'Lorem',
             'modello' => 'SA0980',
             'marca' => 'Phony',
             'foto' => 'images/products/iphone.jpg'],
            ['nome' => 'Iphone Z',
            'descrizione' => 'Descrizione prodotto X',
             'tecniche_uso' => 'Lorem Ipsum',
             'mod_installazione' => 'Lorem',
             'modello' => 'SA0980',
             'marca' => 'Phony',
             'foto' => 'images/products/iphone.jpg'],
            ['nome' => 'Iphone Z',
            'descrizione' => 'Descrizione prodotto X',
             'tecniche_uso' => 'Lorem Ipsum',
             'mod_installazione' => 'Lorem',
             'modello' => 'SA0980',
             'marca' => 'Phony',
             'foto' => 'images/products/laptop.jpg'],
            ['nome' => 'Iphone Z',
            'descrizione' => 'Descrizione prodotto X',
             'tecniche_uso' => 'Lorem Ipsum',
             'mod_installazione' => 'Lorem',
             'modello' => 'SA0980',
             'marca' => 'Phony',
             'foto' => 'images/products/laptop.jpg'],
            ['nome' => 'Iphone Z',
            'descrizione' => 'Descrizione prodotto X',
             'tecniche_uso' => 'Lorem Ipsum',
             'mod_installazione' => 'Lorem',
             'modello' => 'SA0980',
             'marca' => 'Phony',
             'foto' => 'images/products/laptop.jpg'],
            ['nome' => 'Iphone Z',
            'descrizione' => 'Descrizione prodotto X',
             'tecniche_uso' => 'Lorem Ipsum',
             'mod_installazione' => 'Lorem',
             'modello' => 'SA0980',
             'marca' => 'Phony',
             'foto' => 'images/products/iphone.jpg'],
            ['nome' => 'Iphone Z',
            'descrizione' => 'Descrizione prodotto X',
             'tecniche_uso' => 'Lorem Ipsum',
             'mod_installazione' => 'Lorem',
             'modello' => 'SA0980',
             'marca' => 'Phony',
             'foto' => 'images/products/laptop.jpg'],
        ]);
    }
}
