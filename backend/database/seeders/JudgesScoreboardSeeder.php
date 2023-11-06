<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use DB;

class JudgesScoreboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('judges_scoreboards')->insert([
            'event_judge'=>1,
            'event_criteria'=>1,
            'squad_id' => 1,
            'score' => 5,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('judges_scoreboards')->insert([
            'event_judge'=>1,
            'event_criteria'=>2,
            'squad_id' => 1,
            'score' => 5,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('judges_scoreboards')->insert([
            'event_judge'=>1,
            'event_criteria'=>3,
            'squad_id' => 1,
            'score' => 5,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('judges_scoreboards')->insert([
            'event_judge'=>1,
            'event_criteria'=>4,
            'squad_id' => 1,
            'score' => 5,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('judges_scoreboards')->insert([
            'event_judge'=>1,
            'event_criteria'=>5,
            'squad_id' => 1,
            'score' => 5,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);


        DB::table('judges_scoreboards')->insert([
            'event_judge'=>2,
            'event_criteria'=>1,
            'squad_id' => 1,
            'score' => 5,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('judges_scoreboards')->insert([
            'event_judge'=>2,
            'event_criteria'=>2,
            'squad_id' => 1,
            'score' => 5,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('judges_scoreboards')->insert([
            'event_judge'=>2,
            'event_criteria'=>3,
            'squad_id' => 1,
            'score' => 5,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('judges_scoreboards')->insert([
            'event_judge'=>2,
            'event_criteria'=>4,
            'squad_id' => 1,
            'score' => 5,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('judges_scoreboards')->insert([
            'event_judge'=>2,
            'event_criteria'=>5,
            'squad_id' => 1,
            'score' => 5,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
    }
}
