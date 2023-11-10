<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->getOutput()->progressStart(4);
        $this->call([RegionSeeder::class]);
        $this->command->getOutput()->progressAdvance();
        $this->call([ProvinceSeeder::class]);
        $this->command->getOutput()->progressAdvance();
        $this->call([CityMunSeeder::class]);
        $this->command->getOutput()->progressAdvance();
        $this->call([R1BrgySeeder::class]);
        $this->command->getOutput()->progressAdvance();
        $this->command->getOutput()->progressFinish();
    }
}
