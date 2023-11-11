<?php

namespace App\Http\Controllers;

use App\Models\ReportRef;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class RefController extends Controller
{
    public function jenisLaporan(){
        // $data = ReportRef::with('levelName')->latest()->get();
        // dd($data);
        return view("admin.daftar_laporan",['title'=>'Ref Laporan']);
    }

    public function getJenisLaporan(Request $request)
    {
        if ($request->ajax()) {
            $data = ReportRef::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="" class="edit btn btn-success btn-sm" onclick="showModalEdit('.$row->id.'); return false">Edit</a> <a href=""  onclick="deleteLaporan('.$row->id.');return false" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('level_name', function($row){
                    
                    return $row->levelName->level_name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function addLaporan(Request $request){
        $validate=Validator::make(
            $request->all(),
            [
                'report_name'=>['required'],
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
        $validate=Validator::make(
            $request->all(),
            [
                'report_name'=>['required'],
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
        ReportRef::destroy($request->id);
        return response()->json(['msg'=>'success']);
    }
}
