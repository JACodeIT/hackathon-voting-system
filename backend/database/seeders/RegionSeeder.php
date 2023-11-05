<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ref_region')->insert([
            'psgcCode'=> '010000000',
            'regDesc' => 'REGION I (ILOCOS REGION)',
            'regCode' => '01',
            'isSystemDefault' => 1,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('ref_region')->insert([
            'psgcCode'=> '020000000',
            'regDesc' => 'REGION II (CAGAYAN VALLEY)',
            'regCode' => '02',
            'isSystemDefault' => 1,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('ref_region')->insert([
            'psgcCode'=> '030000000',
            'regDesc' => 'REGION III (CENTRAL LUZON)',
            'regCode' => '03',
            'isSystemDefault' => 1,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
            
        ]);
        DB::table('ref_region')->insert([
            'psgcCode'=> '040000000',
            'regDesc' => 'REGION IV-A (CALABARZON)',
            'regCode' => '04',
            'isSystemDefault' => 1,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
            
        ]);
        DB::table('ref_region')->insert([
            'psgcCode'=> '170000000',
            'regDesc' => 'REGION IV-B (MIMAROPA)',
            'regCode' => '17',
            'isSystemDefault' => 1,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
            
        ]);
        DB::table('ref_region')->insert([
            'psgcCode'=> '050000000',
            'regDesc' => 'REGION V (BICOL REGION)',
            'regCode' => '05',
            'isSystemDefault' => 1,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
            
        ]);
        DB::table('ref_region')->insert([
            'psgcCode'=> '060000000',
            'regDesc' => 'REGION VI (WESTERN VISAYAS)',
            'regCode' => '06',
            'isSystemDefault' => 1,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
            
        ]);
        DB::table('ref_region')->insert([
            'psgcCode'=> '070000000',
            'regDesc' => 'REGION VII (CENTRAL VISAYAS)',
            'regCode' => '07',
            'isSystemDefault' => 1,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
            
        ]);
        DB::table('ref_region')->insert([
            'psgcCode'=> '080000000',
            'regDesc' => 'REGION VIII (EASTERN VISAYAS)',
            'regCode' => '08',
            'isSystemDefault' => 1,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
            
        ]);
        DB::table('ref_region')->insert([
            'psgcCode'=> '090000000',
            'regDesc' => 'REGION IX (ZAMBOANGA PENINSULA)',
            'regCode' => '09',
            'isSystemDefault' => 1,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
            
        ]);
        DB::table('ref_region')->insert([
            'psgcCode'=> '100000000',
            'regDesc' => 'REGION X (NORTHERN MINDANAO)',
            'regCode' => '10',
            'isSystemDefault' => 1,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
            
        ]);
        DB::table('ref_region')->insert([
            'psgcCode'=> '110000000',
            'regDesc' => 'REGION XI (DAVAO REGION)',
            'regCode' => '11',
            'isSystemDefault' => 1,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
            
        ]);
        DB::table('ref_region')->insert([
            'psgcCode'=> '120000000',
            'regDesc' => 'REGION XII (SOCCSKSARGEN)',
            'regCode' => '12',
            'isSystemDefault' => 1,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
            
        ]);
        DB::table('ref_region')->insert([
            'psgcCode'=> '130000000',
            'regDesc' => 'NATIONAL CAPITAL REGION (NCR)',
            'regCode' => '13',
            'isSystemDefault' => 1,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
            
        ]);
        DB::table('ref_region')->insert([
            'psgcCode'=> '140000000',
            'regDesc' => 'CORDILLERA ADMINISTRATIVE REGION (CAR)',
            'regCode' => '14',
            'isSystemDefault' => 1,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
            
        ]);
        DB::table('ref_region')->insert([
            'psgcCode'=> '150000000',
            'regDesc' => 'AUTONOMOUS REGION IN MUSLIM MINDANAO (ARMM)',
            'regCode' => '15',
            'isSystemDefault' => 1,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
            
        ]);
        DB::table('ref_region')->insert([
            'psgcCode'=> '160000000',
            'regDesc' => 'REGION XIII (Caraga)',
            'regCode' => '16',
            'isSystemDefault' => 1,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
            
        ]);
    }
}
