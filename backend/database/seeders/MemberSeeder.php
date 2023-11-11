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
            'first_name'=>'Daedal',
            'middle_name'=>'',
            'last_name'=>'us',
            'name_extension'=>'',
            'github_account'=>'daedalus.codes',
            'discord_username' => 'webdevdaedalus',
            'user_id' => 1,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
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
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
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
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'ErikaChenChan',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'erikachenchan',
            'discord_username' => 'erikachenchan',
            'user_id' => 4,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'Akini',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'akini',
            'discord_username' => 'akini',
            'user_id' => 5,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'Oshi',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'oshi',
            'discord_username' => 'oshi',
            'user_id' => 6,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'donut',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'donutkrispi',
            'discord_username' => 'donutkrispi',
            'user_id' => 7,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'Fluffybuddy',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'fluffybuddy',
            'discord_username' => 'fluffybuddy',
            'user_id' => 8,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'Andite',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'andite',
            'discord_username' => 'andite',
            'user_id' => 9,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'toney',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'toney',
            'discord_username' => 'toney',
            'user_id' => 10,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'badpapi',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'badpapi',
            'discord_username' => 'badpapi',
            'user_id' => 11,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'hotdog',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'hotdog',
            'discord_username' => 'hotdog',
            'user_id' => 12,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'angrytalong',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'angrytalong',
            'discord_username' => 'angrytalong',
            'user_id' => 13,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'DDuran',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'DDuran',
            'discord_username' => 'DDuran',
            'user_id' => 14,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'denver',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'denver',
            'discord_username' => 'denver',
            'user_id' => 15,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'matchu',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'matchu',
            'discord_username' => 'matchu',
            'user_id' => 16,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'luffy',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'luffy',
            'discord_username' => 'luffy',
            'user_id' => 17,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'benar',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'benar',
            'discord_username' => 'benar',
            'user_id' => 18,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'jellyfish',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'jellyfish',
            'discord_username' => 'jellyfish',
            'user_id' => 19,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'gian',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'getgian',
            'discord_username' => 'getgian',
            'user_id' => 20,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'thermo',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'thermo_ecs',
            'discord_username' => 'thermo_ecs',
            'user_id' => 21,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'asbel',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'asbel',
            'discord_username' => 'asbel',
            'user_id' => 22,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'enigma',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'dev.enigma',
            'discord_username' => 'dev.enigma',
            'user_id' => 23,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'daydreamer',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'daydreamer',
            'discord_username' => 'daydreamer',
            'user_id' => 24,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'delulu',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'delulu',
            'discord_username' => 'deluu',
            'user_id' => 25,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'boybee',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'boybee',
            'discord_username' => 'boybee',
            'user_id' => 26,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'mac angel',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'macangel23',
            'discord_username' => 'macangel23',
            'user_id' => 27,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('members')->insert([
            'first_name'=>'annie',
            'middle_name'=>'',
            'last_name'=>'Daedalus',
            'name_extension'=>'',
            'github_account'=>'annie',
            'discord_username' => 'annie',
            'user_id' => 28,
            'be_rating' => 10,
            'fe_rating' => 10,
            'ui_ux_rating' => 10,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
    }
}
