<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['username' => 'tecntecn',
             'password' => Hash::make('E2owE2ow'),
             'nome' => 'tecn',
             'cognome' => 'tecn',
             'role' => 'tecnico'],
            ['username' => 'staffstaff',
             'password' => Hash::make('E2owE2ow'),
             'nome' => 'staff',
             'cognome' => 'staff',
             'role' => 'staff'],
            ['username' => 'adminadmin',
             'password' => Hash::make('E2owE2ow'),
             'nome' => 'admin',
             'cognome' => 'admin',
             'role' => 'admin']
        ]);
    }
}
