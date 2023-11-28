<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatans=[
            ['nama_jabatan'=>'Ketua'],
            ['nama_jabatan'=>'Wakil Ketua'],
            ['nama_jabatan'=>'Panitera'],
            ['nama_jabatan'=>'Sekretaris'],
            ['nama_jabatan'=>'Panitera Muda Perdata'],
            ['nama_jabatan'=>'Panitera Muda Hukum'],
            ['nama_jabatan'=>'Panitera Muda Pidana'],
            ['nama_jabatan'=>'Kepala Sub Bagian Umum dan Keuangan'],
            ['nama_jabatan'=>'Kepala Sub Bagian PTIP'],
            ['nama_jabatan'=>'Kepala Sub Bagian Kepegawaian dan Ortala'],
            ['nama_jabatan'=>'Hakim Pegawas Kepaniteraan Perdata'],
            ['nama_jabatan'=>'Hakim Pegawas Kepaniteraan Pidana'],
            ['nama_jabatan'=>'Hakim Pegawas Kepaniteraan Hukum'],
            ['nama_jabatan'=>'Hakim Pegawas Sub Bagian Umum dan Keuangan'],
            ['nama_jabatan'=>'Hakim Pegawas Sub PTIP'],
            ['nama_jabatan'=>'Hakim Pegawas Sub Kepegawaian dan Ortala'],
            
            ];

          
        foreach($jabatans as $jabatan){
            $exist=DB::table('ref_jabatan')->where('nama_jabatan',$jabatan['nama_jabatan'])->first();
            if($exist){
                continue;
            }
            DB::table('ref_jabatan')->insert([
                'nama_jabatan' => $jabatan['nama_jabatan'],
                              
            ]);
        }
    }
}
