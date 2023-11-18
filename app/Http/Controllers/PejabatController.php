<?php

namespace App\Http\Controllers;

use App\Models\Pejabat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PejabatController extends Controller
{
    public function index(){
        return view('admin.daftar_pejabat',['title'=>'Daftar Pejabat']);
        
    }

    public function getDaftarPejabat(Request $request)
    {
        if ($request->ajax()) {
            $data = Pejabat::orderBy('jabatan_id')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="" class="edit btn btn-success btn-sm" onclick="showModalEdit('.$row->id.'); return false">Edit</a> <a href=""  onclick="deleteAkun('.$row->id.');return false" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('jabatan', function($row){
                   
                    return $row->jabatanName->nama_jabatan;
                })
               
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function insertPejabat(Request $request){
        $validate=Validator::make($request->all(),
        [
            'nama'=>['required'],
            
            'jabatan_id'=>['required'],
            'nip'=>['required']
               
        ]
        );

        if($validate->fails()){
            return back()->withErrors($validate);
        }
     

       
        if(Pejabat::create(
            [
                'nama'=>$request->nama,
                'jabatan_id'=>$request->jabatan_id,
                'nip'=>$request->nip,
              
            ]
        )){
            return back()->with('success','Pejabat berhasil disimpan');
        }else {
            return back()->with('fail','Pejabat gagal disimpan');
        }


    }

    public function editPejabat(Request $request){
        $validate=Validator::make($request->all(),
        [
            'nama'=>['required'],
            
            'jabatan_id'=>['required'],
            'nip'=>['required']
               
        ]
        );

        if($validate->fails()){
            return back()->withErrors($validate);
        }
     

       
        if(Pejabat::where('id',$request->id)->update(
            [
                'nama'=>$request->nama,
                'jabatan_id'=>$request->jabatan_id,
                'nip'=>$request->nip,
              
            ]
        )){
            return back()->with('success','Pejabat berhasil disimpan');
        }else {
            return back()->with('fail','Pejabat gagal disimpan');
        }


    }

    public function deletePejabat(Request $request){
        Pejabat::destroy($request->id);
        return back()->with('success','Akun berhasil dihapus');
    }

}
