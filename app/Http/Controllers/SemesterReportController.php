<?php

namespace App\Http\Controllers;

use App\Models\QuarterlyReport;
use App\Models\SemesterReport;
use App\Traits\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SemesterReportController extends Controller
{
    use Common;
    public function semester(Request $request){
       
        $level=DB::table('level')->where('level_name',$request->unit)->first();
       
        return view('user.semester_report',['title'=>'Laporan Semester','unit'=>$request->unit,'level_id'=>$level->id,'bagian'=>$level->unit]);
    }

    public function getLaporanSemester(Request $request,$unit)
    {
        $level_id=DB::table('level')->where('level_name',$unit)->first()->id;
        if ($request->ajax()) {
            $data = SemesterReport::with(['reportName'])->whereHas('reportName',function($q) use($level_id) {
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
               
                ->addColumn('file_download', function($row){
                    
                    return '<a href="'.asset('semester_file/'.$row->file).'" class="file btn btn-primary btn-sm" target="_blank">Download</a>';
                })
                ->addColumn('tanggal_laporan', function($row){
                    $report_date=Carbon::parse($row->report_date)->isoFormat('DD MMMM Y');
                    return $report_date;
                })
                ->rawColumns(['action','file_download','tanggal_laporan'])
                ->make(true);
        }
    }

    public function insertLaporanSemester(Request $request){
        $validate=Validator::make($request->all(),
        [
            'report_id'=>['required'],
            'report_date'=>['required'],
            'objek_monitoring'=>['required'],
          
            'hasil_evaluasi'=>['required'],
            'rekomendasi'=>['required'],
            'tindak_lanjut'=>['required'],
            'semester'=>['required'],
            'year'=>['required'],
            'file'=>['required','mimes:pdf','max:10000']
               
        ]
        );

        if($validate->fails()){
            return back()->withErrors($validate);
        }

        $validated=$validate->validate();
            

        $report_name='SemesterReport-'.$request->level_id.'-'.$validated['semester'].'-'.$validated['year'].'.'.$validated['file']->getClientOriginalExtension();

        $validated['file']->storeAs('semester_file',$report_name,'real_public');
        
       
        if(SemesterReport::create(array_merge($validate->safe()->except('file'),['file'=>$report_name]))){
            return back()->with('success','Data berhasil disimpan');
        }else {
            return back()->with('fail','Data gagal disimpan');
        }


    }
    public function editLaporanSemester(Request $request){
        $validate=Validator::make($request->all(),
        [
            'report_id'=>['required'],
            'report_date'=>['required'],
            'objek_monitoring'=>['required'],
          
            'hasil_evaluasi'=>['required'],
            'rekomendasi'=>['required'],
            'tindak_lanjut'=>['required'],
            'semester'=>['required'],
            'year'=>['required'],
            'file'=>['mimes:pdf','max:10000']
               
        ]
        );

        if($validate->fails()){
            return back()->withErrors($validate);
        }

        $validated=$validate->validate();
      
        if(isset($validated['file'])){

            $report_name='SemesterReport-'.$request->level_id.'-'.$validated['semester'].'-'.$validated['year'].'.'.$validated['file']->getClientOriginalExtension();

            $validated['file']->storeAs('semester_file',$report_name,'real_public');
        }else {
            $report_name=$request->file_lama;
        }
        
     
        if(SemesterReport::where('id',$request->id)->update(array_merge($validate->safe()->except('file'),['file'=>$report_name]))){
            return back()->with('success','Data berhasil diedit');
        }else {
            return back()->with('fail','Data gagal diedit');
        }


    }

    public function deleteLaporanSemester(Request $request){

        SemesterReport::destroy($request->id);
        return back()->with('success','Data berhasil dihapus');
    }


}
