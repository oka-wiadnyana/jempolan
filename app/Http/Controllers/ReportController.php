<?php

namespace App\Http\Controllers;

use App\Models\WeeklyReport;
use App\Traits\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    use Common;
    public function mingguan(Request $request){
       
        $level=DB::table('level')->where('level_name',$request->unit)->first();
       
        return view('user.weekly_report',['title'=>'Laporan Mingguan','unit'=>$level->level_name,'level_id'=>$level->id,'bagian'=>$level->unit]);
    }

    public function getLaporanMingguan(Request $request,$unit)
    {
        $level_id=DB::table('level')->where('level_name',$unit)->first()->id;
        if ($request->ajax()) {
            $data = WeeklyReport::with(['reportName'])->whereHas('reportName',function($q) use($level_id) {
                $q->where('level_id',$level_id);
            })->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if(auth()->user()->level->level_name!='admin'){
                        $actionBtn = '<a href="" class="detail btn btn-warning btn-sm" onclick="showModalDetail('.$row->id.'); return false">Detail</a> <a href="" class="edit btn btn-success btn-sm" onclick="showModalEdit('.$row->id.'); return false">Edit</a> <a href=""  onclick="deleteLaporan('.$row->id.');return false" class="delete btn btn-danger btn-sm">Delete</a>';
                    }else {

                        $actionBtn = '<a href="" class="detail btn btn-warning btn-sm" onclick="showModalDetail('.$row->id.'); return false">Detail</a>';
                    }
                   
                    return $actionBtn;
                })
                ->addColumn('report_name', function($row){
                    
                    return $row->reportName?->report_name;
                })
                ->addColumn('bulan', function($row){
                    $months=$this->getMonthNames();
                    $month=collect($months)->where('month_number',$row->month)->first();
                    return $month['month_name'];
                })
                ->addColumn('file_download', function($row){
                    
                    return '<a href="'.asset('weekly_file/'.$row->file).'" class="file btn btn-primary btn-sm" target="_blank">Download</a>';
                })
                ->addColumn('tanggal_laporan', function($row){
                    $report_date=Carbon::parse($row->report_date)->isoFormat('DD MMMM Y');
                    return $report_date;
                })
                ->rawColumns(['action','file_download','tanggal_laporan'])
                ->make(true);
        }
    }

    public function insertLaporanMingguan(Request $request){
        $validate=Validator::make($request->all(),
        [
            'report_id'=>['required'],
            'report_date'=>['required'],
            'objek_monitoring'=>['required'],
            'week'=>['required'],
            'hasil_evaluasi'=>['required'],
            'rekomendasi'=>['required'],
            'tindak_lanjut'=>['required'],
            'month'=>['required'],
            'year'=>['required'],
            'file'=>['required','mimes:pdf','max:10000']
               
        ]
        );

        if($validate->fails()){
            return back()->withErrors($validate);
        }

        $validated=$validate->validate();
            

        $report_name='WeeklyReport-'.$request->level_id.'-'.$validated['week'].'-'.$validated['month'].'-'.$validated['year'].'.'.$validated['file']->getClientOriginalExtension();

        $validated['file']->storeAs('weekly_file',$report_name,'real_public');
        
       
        if(WeeklyReport::create(array_merge($validate->safe()->except('file'),['file'=>$report_name]))){
            return back()->with('success','Data berhasil disimpan');
        }else {
            return back()->with('fail','Data gagal disimpan');
        }


    }
    public function editLaporanMingguan(Request $request){
        $validate=Validator::make($request->all(),
        [
            'report_id'=>['required'],
            'report_date'=>['required'],
            'objek_monitoring'=>['required'],
            'week'=>['required'],
            'hasil_evaluasi'=>['required'],
            'rekomendasi'=>['required'],
            'tindak_lanjut'=>['required'],
            'month'=>['required'],
            'year'=>['required'],
            'file'=>['mimes:pdf','max:10000']
               
        ]
        );

        if($validate->fails()){
            return back()->withErrors($validate);
        }

        $validated=$validate->validate();
      
        if(isset($validated['file'])){

            $report_name='WeeklyReport-'.$request->level_id.'-'.$validated['week'].'-'.$validated['month'].'-'.$validated['year'].'.'.$validated['file']->getClientOriginalExtension();

            $validated['file']->storeAs('weekly_file',$report_name,'real_public');
        }else {
            $report_name=$request->file_lama;
        }
        
     
        if(WeeklyReport::where('id',$request->id)->update(array_merge($validate->safe()->except('file'),['file'=>$report_name]))){
            return back()->with('success','Data berhasil diedit');
        }else {
            return back()->with('fail','Data gagal diedit');
        }


    }

    public function deleteLaporanMingguan(Request $request){

        WeeklyReport::destroy($request->id);
        return back()->with('success','Data berhasil dihapus');
    }


}
