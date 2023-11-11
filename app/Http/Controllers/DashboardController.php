<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
           
        return view('/dashboard');
    }

    public function getDataChart(){

        $jmlLaporanMingguan=[];
        $jmlLaporanBulanan=[];
        $jmlLaporanTriwulan=[];
        $unit=[];

        $levels=DB::table('level')->get();
        foreach($levels as $level){
            if($level->level_name=='super_admin' || $level->level_name=='admin'){
                continue;
            }
            $jmlLaporanMingguan[]=$this->getJmlLaporan($level->level_name,'weekly_report');
            $jmlLaporanBulanan[]=$this->getJmlLaporan($level->level_name,'monthly_report');
            $jmlLaporanTriwulan[]=$this->getJmlLaporan($level->level_name,'quarterly_report');
            $unit[]=$level->level_name;
        }

        $data=[
            'mingguan'=>$jmlLaporanMingguan,
            'bulanan'=>$jmlLaporanBulanan,
            'triwulan'=>$jmlLaporanTriwulan,
            'unit'=>$unit
        ];
        
        return response()->json($data);

    }

    public function getJmlLaporan($unit,$table_report){
        $jml=DB::table($table_report.' as a')->join('report_ref as b','a.report_id','=','b.id')->join('level as c','b.level_id','=','c.id')->where('level_name',$unit)->count();

        return $jml;
    }
}
