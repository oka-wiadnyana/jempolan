<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\ObjectMonev;
use App\Models\ObjectMonevQuarterly;
use App\Models\ObjectMonevSemester;
use App\Models\ObjectMonevWeekly;
use App\Models\ObjectMonevYearly;
use App\Models\ReportRef;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class RefController extends Controller
{
    public function jenisLaporan($levelName=null){
        // $data = ReportRef::with('levelName')->latest()->get();
       
        return view("admin.daftar_laporan",['title'=>'Ref Laporan','levelName'=>$levelName]);
    }

    public function getJenisLaporan(Request $request,$levelName=null)
    {
        $levelId=Level::where('level_name',$levelName)->first();
        if ($request->ajax()) {
            
            $data = $levelId?ReportRef::where('level_id',$levelId->id)->get():ReportRef::orderBy('level_id')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="" class="edit btn btn-success btn-sm" onclick="showModalEdit('.$row->id.'); return false">Edit</a> <a href=""  onclick="deleteLaporan('.$row->id.');return false" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('level_name', function($row){
                    
                    return $row->levelName->level_name;
                })
                ->addColumn('periode_name', function($row){
                    
                    return $row->periodeName->periode_name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function addLaporan(Request $request){
        $validate=Validator::make(
            $request->all(),
            [
                'report_name'=>['required',
                Rule::unique('report_ref')->where('report_name', $request->report_name)->where('level_id',$request->level_id)->where('periode',$request->periode)
            
                ],
                'periode'=>['required'],
                'level_id'=>['required'],
            ]
            );

        if($validate->fails()){
            return back()->withErrors($validate);
        }

        $validated=$validate->safe()->all();
        
        try {
            ReportRef::create($validated);
            return back()->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return back()->with('fail', $e->getMessage());
        }
       


    }

    public function editLaporan(Request $request){
        // dd($request->all());
        $validate=Validator::make(
            $request->all(),
            [
                'report_name'=>['required',
                Rule::unique('report_ref')->where('report_name', $request->report_name)->where('level_id',$request->level_id)->where('periode',$request->periode)],
                'periode'=>['required'],
                'level_id'=>['required'],
            ]
            );

        if($validate->fails()){
            return back()->withErrors($validate);
        }

        $validated=$validate->safe()->all();
        
        try {
            ReportRef::where('id',$request->id)->update($validated);
            return back()->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            return back()->with('fail', $e->getMessage());
        }
       


    }

    public function deleteLaporan(Request $request){
        $periode=ReportRef::where('id',$request->id)->first();

        ReportRef::destroy($request->id);
        if($periode->periode==2){
            ObjectMonev::where('report_id',$request->id)->delete();
        }elseif($periode->periode==3){
            ObjectMonevQuarterly::where('report_id',$request->id)->delete();
        }

        return response()->json(['msg'=>'success']);
    }

    public function refObjectMonev(Request $request, $periode,$levelName=null){
        return view('admin.daftar_object',['title'=>'Object Monev '.ucwords($periode),'periode'=>$periode,'levelName'=>$levelName]);
    }

    public function getObjectMonev(Request $request,$periode,$levelName=null)
    {
        
        if ($request->ajax()) {
            $levelId=Level::where('level_name',$levelName)->first();
         
            if($periode=='mingguan'){
                if($levelId){

                    $data = ObjectMonevWeekly::orderBy('report_id')->whereHas('levelName',function($q) use($levelId){
                         $q->where('level_id',$levelId->id);
                     })->get();
                }else {
                    $data = ObjectMonevWeekly::orderBy('report_id')->get();
                }
            }elseif($periode=='bulanan'){

                if($levelId){
                    $data = ObjectMonev::orderBy('report_id')->whereHas('levelName',function($q) use($levelId){
                        $q->where('level_id',$levelId->id);
                    })->get();
                }else {
                    $data = ObjectMonev::orderBy('report_id')->get();
                }
            }elseif($periode=='triwulan'){
                if($levelId){
                $data = ObjectMonevQuarterly::orderBy('report_id')->whereHas('levelName',function($q) use($levelId){
                    $q->where('level_id',$levelId->id);
                })->get();
                }else {
                    $data = ObjectMonevQuarterly::orderBy('report_id')->get();
                }
            }elseif($periode=='semester'){
                if($levelId){
                    $data = ObjectMonevSemester::orderBy('report_id')->whereHas('levelName',function($q) use($levelId){
                        $q->where('level_id',$levelId->id);
                    })->get();
                }else{
                    if($levelId){
                        $data = ObjectMonevSemester::orderBy('report_id')->whereHas('levelName',function($q) use($levelId){
                            $q->where('level_id',$levelId->id);
                        })->get();
                    }else{
                        $data = ObjectMonevSemester::orderBy('report_id')->get();
                    }
                }
            }elseif($periode=='tahunan'){
                if($levelId){
                $data = ObjectMonevYearly::orderBy('report_id')->whereHas('levelName',function($q) use($levelId){
                    $q->where('level_id',$levelId->id);
                })->get();
                }else {
                    $data = ObjectMonevYearly::orderBy('report_id')->get();
                }
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) use($periode){
                    $actionBtn = '<a href="" class="edit btn btn-success btn-sm" onclick="showModalEdit('.$row->id.',\''.$periode.'\'); return false">Edit</a> <a href=""  onclick="deleteLaporan('.$row->id.',\''.$periode.'\');return false" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('report_name', function($row){
                    
                    return $row->reportName->report_name;
                })
                ->addColumn('periode_name', function($row){
                    
                    return $row->periodeName->periode_name;
                })
                ->addColumn('level_name', function($row){
                    
                    return $row->levelName->level_name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function addObject(Request $request){
        $validate=Validator::make(
            $request->all(),
            [
                'report_id'=>['required'],
                'object_name'=>['required'],
            
            ]
            );

        if($validate->fails()){
            return back()->withErrors($validate);
        }

        $validated=$validate->safe()->all();

        $report_data=ReportRef::where('id',$validated['report_id'])->first();
        

        try {

            if($report_data->periode==1){

                ObjectMonevWeekly::create($validated);
            }elseif($report_data->periode==2){

                ObjectMonev::create($validated);
            }elseif($report_data->periode==3){
                ObjectMonevQuarterly::create($validated);
            }elseif($report_data->periode==4){
                ObjectMonevSemester::create($validated);
            }elseif($report_data->periode==5){
                ObjectMonevYearly::create($validated);
            }
            return back()->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return back()->with('fail', $e->getMessage());
        }
       


    }

    public function editObject(Request $request){
        $validate=Validator::make(
            $request->all(),
            [
                'report_id'=>['required'],
                'object_name'=>['required'],
            
            ]
            );

        if($validate->fails()){
            return back()->withErrors($validate);
        }

        $validated=$validate->safe()->all();

        // $report_data=ReportRef::where('id',$validated['report_id'])->first();
        
// dd($validated,$request->periode,$request->id);
        try {

            if($request->periode==2){

                ObjectMonev::where('id',$request->id)->update($validated);
            }elseif($request->periode==3){
                ObjectMonevQuarterly::where('id',$request->id)->update($validated);
            }
            return back()->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return back()->with('fail', $e->getMessage());
        }
       


    }

    public function deleteObject(Request $request){
        if($request->periode=='bulanan'){

            ObjectMonev::destroy($request->id);
        }elseif($request->periode=='triwulan'){
            ObjectMonevQuarterly::destroy($request->id);
        }
        return response()->json(['msg'=>'success']);
    }
}
