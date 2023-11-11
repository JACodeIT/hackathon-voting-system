<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use DB;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('criterias')->insert([
            'criterion_id'=>'1',
            'min_rating'=>'1.00',
            'max_rating'=>'5.00',
            'percentage_value'=>'20',
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('criterias')->insert([
            'criterion_id'=>'2',
            'min_rating'=>'1.00',
            'max_rating'=>'5.00',
            'percentage_value'=>'20',
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('criterias')->insert([
            'criterion_id'=>'3',
            'min_rating'=>'1.00',
            'max_rating'=>'5.00',
            'percentage_value'=>'20',
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('criterias')->insert([
            'criterion_id'=>'4',
            'min_rating'=>'1.00',
            'max_rating'=>'5.00',
            'percentage_value'=>'20',
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('criterias')->insert([
            'criterion_id'=>'5',
            'min_rating'=>'1.00',
            'max_rating'=>'5.00',
            'percentage_value'=>'20',
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
    }
}
