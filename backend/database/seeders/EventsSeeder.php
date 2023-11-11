<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use DB;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            'organizer_id'=> 2,
            'topic'=>'Hackathon Voting System',
            'start_date'=>Carbon::yesterday('Asia/Manila'),
            'end_date'=>Carbon::now('Asia/Manila')->addDays(7),
            'announcement_date'=>Carbon::now('Asia/Manila')->addDays(10)    ,
            'description'=>'Join our high-energy hackathon on November 4, 2023, at 10:30 PM! Unleash your creativity, collaborate with fellow innovators, and create something amazing. Your presence is essential for this epic tech challenge. A roll call will be done. Dont miss out!',
            'venue' => 'Discord',
            'address_line_1' => '',
            'address_line_2' => '',
            'brgy_address' => 1,
            'complete_address' => '',
            'status' => 'Upcoming',
            'banner_url' => 'https://daedalus.codes/neon-robot.webp',
            'isGroup' => '1',
            'number_of_members' => '5',
            'public_can_vote' => '0',
            'member_can_vote' => '1',
            'public_numbers_of_vote' => '0',
            'member_numbers_of_vote' => '1',
            'judge_vote_percentage' => '80',
            'member_vote_percentage' => '20',
            'public_vote_percentage' => '0',
            'maximum_registrants' => 25,
            'created_at'    => Carbon::now('Asia/Manila'),
            'updated_at'    => Carbon::now('Asia/Manila')
        ]);
    }
}
