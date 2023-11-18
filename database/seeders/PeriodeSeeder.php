<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $periodes=['mingguan','bulanan','triwulan','semester','tahunan'];

        foreach($periodes as $periode){
            DB::table('periode_ref')->insert([
                'periode_name'=>$periode
            ]);
        }
    }
}
