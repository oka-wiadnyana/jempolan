<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class OtentifikasiController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function attemptLogin(Request $request){

       
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials,$request->remember_me)) {
            $request->session()->regenerate();
            
            return redirect()->intended('/');
        }
 
        return back()->withErrors($credentials)->onlyInput('username');

    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }

    public function daftarAkun(){
        return view('admin.daftar_akun',['title'=>'Daftar Akun']);
    }

    public function getDaftarAkun(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="" class="edit btn btn-success btn-sm" onclick="showModalEdit('.$row->id.'); return false">Edit</a> <a href=""  onclick="deleteAkun('.$row->id.');return false" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('role_name', function($row){
                    $role_name=Level::where('id',$row->role)->first();
                    return $role_name->level_name;
                })
               
                ->rawColumns(['action','role_name'])
                ->make(true);
        }
    }

    public function insertAkun(Request $request){
        $validate=Validator::make($request->all(),
        [
            'name'=>['required'],
            'username'=>['required','unique:users,username'],
            'role'=>['required'],
            'password'=>['required','confirmed']
               
        ]
        );

        if($validate->fails()){
            return back()->withErrors($validate);
        }
     

       
        if(User::create(
            [
                'name'=>$request->name,
                'username'=>$request->username,
                'role'=>$request->role,
                'password'=>Hash::make($request->password)
            ]
        )){
            return back()->with('success','Akun berhasil disimpan');
        }else {
            return back()->with('fail','Akun gagal disimpan');
        }


    }

    public function editAkun(Request $request){
        $validate=Validator::make($request->all(),
        [
            'name'=>['required'],
            'username'=>['required'],
            'role'=>['required'],
            'password'=>['nullable','confirmed']
               
        ]
        );

        if($validate->fails()){
            return back()->withErrors($validate);
        }
     

        if($request->password){
            $inputValue= [
                'name'=>$request->name,
                'username'=>$request->username,
                'role'=>$request->role,
                'password'=>Hash::make($request->password)
            ];
        }else {
            $inputValue= [
                'name'=>$request->name,
                'username'=>$request->username,
                'role'=>$request->role,
            ];
        }
       
        if(User::where('id',$request->id)->update(
           $inputValue
        )){
            return back()->with('success','Akun berhasil diupdate');
        }else {
            return back()->with('fail','Akun gagal diupdate');
        }


    }

    public function deleteAkun(Request $request){
        User::destroy($request->id);
        return back()->with('success','Akun berhasil dihapus');
    }

}
