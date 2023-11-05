<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrgySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->getOutput()->progressStart(10);
        for ($i = 0; $i < 17; $i++) {
            $this->call([
              R1BrgySeeder::class,
              R2BrgySeeder::class,
              R3BrgySeeder::class,
              R4BrgySeeder::class,
              R5BrgySeeder::class,
              R6BrgySeeder::class,
              R7BrgySeeder::class,
              R8BrgySeeder::class,
              R9BrgySeeder::class,
              R10BrgySeeder::class,
              R11BrgySeeder::class,
              R12BrgySeeder::class,
              R13BrgySeeder::class,
              R14BrgySeeder::class,
              R15BrgySeeder::class,
              R16BrgySeeder::class,
              R17BrgySeeder::class,
            ]);
            $this->command->getOutput()->progressAdvance();
        }
    }
}
