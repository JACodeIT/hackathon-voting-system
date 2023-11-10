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
            'username'=>'daedalus_admin',
            'email'=>'admin@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'ADMIN',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);


        DB::table('users')->insert([
            'username'=>'Timelord',
            'email'=>'mjrolex@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'ORGANIZER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'directormac',
            'email'=>'artifex@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'JUDGE',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'erikachenchan',
            'email'=>'erikachenchan@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD LEADER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'akini',
            'email'=>'akini@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'oshi',
            'email'=>'oshi@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'krispi_donut',
            'email'=>'krispi_donut@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'fluffybuddy',
            'email'=>'fluffybuddy@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'andite',
            'email'=>'andite@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD LEADER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'toney010319',
            'email'=>'toney010319@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'BadPapi',
            'email'=>'BadPapi@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'hotdog',
            'email'=>'hotdog@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'angrytalong',
            'email'=>'angrytalong@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'DDuran19',
            'email'=>'DDuran19@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD LEADER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'denver',
            'email'=>'denver@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'matchu',
            'email'=>'matchu@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'luffy',
            'email'=>'luffy@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'benar',
            'email'=>'benar@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'jellyfish',
            'email'=>'jellyfish@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD LEADER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'getgian',
            'email'=>'getgian@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'thermo_ecs',
            'email'=>'thermo_ecs@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'asbel',
            'email'=>'asbel@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'dev.enigma',
            'email'=>'dev.enigma@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'daydreamer',
            'email'=>'daydreamer@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'delulu',
            'email'=>'delulu@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD LEADER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'boybee',
            'email'=>'boybee@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'macangel23',
            'email'=>'macangel23@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

        DB::table('users')->insert([
            'username'=>'annie',
            'email'=>'annie@daedalus.codes',
            'password'=> Hash::make('Password@@123'),
            'roles' => 'SQUAD MEMBER',
            'remember_token'=> Str::random(10),
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
    }
}
