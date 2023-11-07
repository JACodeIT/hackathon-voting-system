<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('members')->insert([
            'first_name'=>'JA',
            'middle_name'=>'N',
            'last_name'=>'Cereno',
            'name_extension'=>'',
            'github_account'=>'JACodeIT',
            'discord_username' => 'jacodeit.dev',
            'user_id' => 1,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'MJ',
            'middle_name'=>'',
            'last_name'=>'Rolex',
            'name_extension'=>'',
            'github_account'=>'mjrolex',
            'discord_username' => 'mjrolex',
            'user_id' => 2,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'Mac',
            'middle_name'=>'',
            'last_name'=>'Director',
            'name_extension'=>'',
            'github_account'=>'directormac',
            'discord_username' => 'directormac',
            'user_id' => 3,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
    }
}
