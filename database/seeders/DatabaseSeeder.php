<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $levels=[
            ['level'=>'super_admin',
            'unit'=>env("SATKER")],
            ['level'=>'admin',
            'unit'=>env("SATKER")],
            ['level'=>'perdata',
            'unit'=>'Kepaniteraan Perdata'],
            ['level'=>'hukum',
            'unit'=>'Kepaniteraan Hukum'],
            ['level'=>'pidana',
            'unit'=>'Kepaniteraan Pidana'],
            ['level'=>'ptip',
            'unit'=>'PTIP'],
            ['level'=>'kepeg_ortala',
            'unit'=>'Kepegawaian dan Ortala'],
            ['level'=>'umum_keu',
            'unit'=>'Umum dan Keuangan'],
            ];

        foreach($levels as $level){
            DB::table('level')->insert([
                'level_name' => $level['level'],
                'unit' => $level['unit'],
                
            ]);
        }
     
    }
}
