<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use DB;

class CriterionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('criterions')->insert([
            'criterion'=>'Functionality',
            'description'=>'Access the core functionality of the web app.  - Does it effectively perform the intended task or solve the problem it was designed for? - It is user-friendly and easy to navigate? - Does it work as expected?',
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('criterions')->insert([
            'criterion'=>'Design and User Experience (UI/UX)',
            'description'=>'Overall design, layout, user interface, and ease of use. - How east it is to find information? - Are there any wasted space? - Accessibility?',
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('criterions')->insert([
            'criterion'=>'Technical Complexity and Code Quality',
            'description'=>'- Is the code well-structured and maintainable? - Does it follow best practices and coding standards? - Hows the readability? - Are there any tests?',
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('criterions')->insert([
            'criterion'=>'Demo Presentation',
            'description'=>'Participants ability to present and explain their web app. - Did they effectively communicate their idea and how it works? - Did they showcase the key features and benefits? - Did they answer questions confidently and knowledgeably?',
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
        DB::table('criterions')->insert([
            'criterion'=>'Creativty and Originality',
            'description'=>'- What makes their solution unique? - Any clever way of storing, presenting, serving information?',
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila')
        ]);
    }
}
