<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use DB;

class SquadMembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('squad_members')->insert([
            'squad_id'=>1,
            'member_id'=>5,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('squad_members')->insert([
            'squad_id'=>1,
            'member_id'=>6,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('squad_members')->insert([
            'squad_id'=>1,
            'member_id'=>7,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('squad_members')->insert([
            'squad_id'=>1,
            'member_id'=>8,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('squad_members')->insert([
            'squad_id'=>2,
            'member_id'=>10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('squad_members')->insert([
            'squad_id'=>2,
            'member_id'=>11,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('squad_members')->insert([
            'squad_id'=>2,
            'member_id'=>12,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('squad_members')->insert([
            'squad_id'=>2,
            'member_id'=>13,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('squad_members')->insert([
            'squad_id'=>3,
            'member_id'=>15,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('squad_members')->insert([
            'squad_id'=>3,
            'member_id'=>16,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('squad_members')->insert([
            'squad_id'=>3,
            'member_id'=>17,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('squad_members')->insert([
            'squad_id'=>3,
            'member_id'=>18,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('squad_members')->insert([
            'squad_id'=>4,
            'member_id'=>20,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('squad_members')->insert([
            'squad_id'=>4,
            'member_id'=>21,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('squad_members')->insert([
            'squad_id'=>4,
            'member_id'=>22,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('squad_members')->insert([
            'squad_id'=>4,
            'member_id'=>23,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('squad_members')->insert([
            'squad_id'=>5,
            'member_id'=>24,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('squad_members')->insert([
            'squad_id'=>5,
            'member_id'=>26,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('squad_members')->insert([
            'squad_id'=>5,
            'member_id'=>27,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('squad_members')->insert([
            'squad_id'=>5,
            'member_id'=>28,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
    }
}
