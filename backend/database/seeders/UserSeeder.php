<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'username'=>'jacodeit',
            'email'=>'jacodeit@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);


        DB::table('users')->insert([
            'username'=>'Timelord',
            'email'=>'mjrolex@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'directormac',
            'email'=>'artifex@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
    }
}
