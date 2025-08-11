<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersSeeder::class);
        $this->call(AssistanceSeeder::class);
        $this->call(TecnicoAssistenzaSeeder::class);
        $this->call(StaffTecnicoSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(MalfunctionSeeder::class);
        $this->call(SolutionSeeder::class);
    }
}
