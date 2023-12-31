<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use DB;

class SquadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('squads')->insert([
            'leader_id'=>4,
            'name'=>'Team CHIBOG',
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('squads')->insert([
            'leader_id'=>9,
            'name'=>'ReactPressPHP',
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('squads')->insert([
            'leader_id'=>14,
            'name'=>'CastAway',
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('squads')->insert([
            'leader_id'=>19,
            'name'=>'Performance task sa mapeh',
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('squads')->insert([
            'leader_id'=>25,
            'name'=>"D'Rocketeers",
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
    }
}
