<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@daedalus.codes',
        // ]);

        $this->call([
            DefaultPlaceSeeder::class,
            UserSeeder::class,
            MemberSeeder::class,
            EventsSeeder::class,
            SquadsSeeder::class,
            SquadsSeeder::class,
            CriterionSeeder::class,
            CriteriaSeeder::class,
            EventCriteriaSeeder::class,
            EventJudgesSeeder::class,
            EventSquadsSeeder::class,
            SquadMembersSeeder::class,
            // JudgesScoreboardSeeder::class,
        ]);
    }
}
