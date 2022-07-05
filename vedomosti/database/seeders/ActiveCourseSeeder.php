<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActiveCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('active_courses')->insert([
            'id' => '1',
            'id_student' => '1',
            'id_course' => '1',
            'grade'=>[
                '0'=>4,'1'=>5,'2'=>4,'3'=>5,
                ],
        ]);
    }
}
