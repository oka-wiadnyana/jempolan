<?php

namespace App\Http\Controllers;

use App\Models\MonevQuarterly;
use App\Models\MonevSemester;
use App\Models\SemesterReport;
use App\Models\ObjectMonev;
use App\Models\ObjectMonevQuarterly;
use App\Models\ObjectMonevSemester;
use App\Models\Pejabat;
use App\Traits\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpWord\TemplateProcessor;
use Yajra\DataTables\DataTables;

class SemesterReportController extends Controller
{
    use Common;
    public function semester(Request $request){
        // $data = SemesterReport::where('level_id',3)->latest()->get();
        // $data_m=$data[0]->monevSemester->isEmpty();
        // dd($data_m);
        
     
        $level=DB::table('level')->where('level_name',$request->unit)->first();
       
        return view('user.semester.semester_report',['title'=>'Laporan Semester','unit'=>$request->unit,'level_id'=>$level->id,'bagian'=>$level->unit]);
    }

    public function getLaporanSemester(Request $request,$unit)
    {
        
        if ($request->ajax()) {
            $data = SemesterReport::where('level_id',$unit)->latest()->get();
            // $monev_exist=$data->monevSemester;
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if(auth()->user()->level->level_name!='admin'){
                      $monev_exist=!$row->monevSemester->isEmpty();
                      $mode=!$row->monevSemester->isEmpty()?"edit":"";
                      $data_tl=$row->monevSemester;
                      $mode_tl='';
                        foreach($data_tl as $d){
                            if($d->tindak_lanjut!=null&&$d->tindak_lanjut!=""){
                                $mode_tl='edit';
                            
                            }
                            break;
                        }
                     
                      $btn_tl=$monev_exist?'<a href="'.url('/add_tl_monev_semester/'.$row->id.'/'.$row->level_id.'/'.$mode_tl).'" class="detail btn btn-secondary btn-sm" >TL</a>':'';
                        $actionBtn = '<a href="'.url('/add_monev_semester/'.$row->id.'/'.$row->level_id.'/'.$mode).'" class="detail btn btn-warning btn-sm" >Monev</a> <a href="" class="edit btn btn-success btn-sm" onclick="showModalEdit('.$row->id.'); return false">Edit</a> <a href=""  onclick="deleteLaporan('.$row->id.');return false" class="delete btn btn-danger btn-sm">Delete</a> <a href="'.url('/download_monev_semester/'.$row->id).'" class="detail btn btn-info btn-sm" onclick="showModalDownload('.$row->id.'); return false">Download</a> '.$btn_tl;
                    }else {

                        $actionBtn = '<a href="'.url('/download_monev_semester/'.$row->id).'" class="detail btn btn-info btn-sm" onclick="showModalDownload('.$row->id.'); return false">Download</a> ';
                    }
                    return $actionBtn;
                })
               
               
                ->addColumn('file_download', function($row){
                    if($row->file){

                        return '<a href="'.asset('semester_file/'.$row->file).'" class="file btn btn-primary btn-sm" target="_blank">Download</a>';
                    }else {
                        if(auth()->user()->level->level_name!='admin'){
                        return '<a href="" class="upload btn btn-warning btn-sm" onclick="showModalUpload('.$row->id.',\'semester\'); return false">Upload</a>';
                        }
                    }
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
            'report_name'=>['required'],
            'report_date'=>['required'],
            'level_id'=>['required'],
          
            'semester'=>['required'],
            'year'=>['required'],
            // 'file'=>['required','mimes:pdf','max:10000']
               
        ]
        );

        if($validate->fails()){
            return back()->withErrors($validate);
        }

        $validated=$validate->validate();
            

        // $report_name='SemesterReport-'.$request->level_id.'-'.$validated['month'].'-'.$validated['year'].'.'.$validated['file']->getClientOriginalExtension();

        // $validated['file']->storeAs('quarterly_file',$report_name,'real_public');
        
       
        if(SemesterReport::create($validate->safe()->all())){
            return back()->with('success','Data berhasil disimpan');
        }else {
            return back()->with('fail','Data gagal disimpan');
        }


    }
    public function editLaporanSemester(Request $request){
        $validate=Validator::make($request->all(),
        [
            'report_name'=>['required'],
            'report_date'=>['required'],
            'level_id'=>['required'],
          
            'semester'=>['required'],
            'year'=>['required'],
               
        ]
        );

        if($validate->fails()){
            return back()->withErrors($validate);
        }

        $validated=$validate->validate();
      
        // if(isset($validated['file'])){

        //     $report_name='SemesterReport-'.$request->level_id.'-'.$validated['month'].'-'.$validated['year'].'.'.$validated['file']->getClientOriginalExtension();

        //     $validated['file']->storeAs('quarterly_file',$report_name,'real_public');
        // }else {
        //     $report_name=$request->file_lama;
        // }
        
     
        if(SemesterReport::where('id',$request->id)->update($validate->safe()->all())){
            return back()->with('success','Data berhasil diedit');
        }else {
            return back()->with('fail','Data gagal diedit');
        }


    }

    public function deleteLaporanSemester(Request $request){

        SemesterReport::destroy($request->id);
        return back()->with('success','Data berhasil dihapus');
    }

    public function addMonev(Request $request,$report_id,$unit,$mode=null){

        $thisReport=SemesterReport::where('id',$report_id)->first();

        $objects=ObjectMonevSemester::whereHas('levelName',function($q)use($unit){
            $q->where('level.id',$unit);
        })->whereHas('reportName',function($q)use($thisReport){
            $q->where('report_name',$thisReport->report_name);
        })->get();
// dd($report_id);
        $monevs=MonevSemester::where('report_id',$report_id)->get();
        // dd($monevs);
        $unit_name=DB::table('level')->where('id',$unit)->first();
        return view('user.semester.monev_semester_view',['objects'=>$objects,'title'=>'Tambah Monev','bagian'=>$unit_name->unit,'report_id'=>$report_id,'monevs'=>$monevs,'mode'=>$mode,'level_name'=>$unit_name->level_name]);
    }

    public function insertMonev(Request $request){
        $validate=Validator::make($request->all(),
        [
            'object_name.*'=>['required'],
            'kesesuaian.*'=>['required'],
            'ketidaksesuaian.*'=>['required'],
                      
            'tindakan_perbaikan.*'=>['required'],
            'penanggung_jawab.*'=>['required'],
            'close_date.*'=>['nullable'],
            'report_id'=>['required'],
            // 'file'=>['required','mimes:pdf','max:10000']
               
        ]
        );

        if($validate->fails()){
            return back()->withErrors($validate);
        }

        $validated=$validate->safe();

       $data_length=count($validated['object_name']);
    //    dd($data_length);

        for($i=0;$i<$data_length;$i++){
            if($request->mode=='edit'){
                MonevSemester::where('id',$request->monev_id[$i])->update(
                    [
                    'object_name'=>$validated['object_name'][$i],'kesesuaian'=>$validated['kesesuaian'][$i],'ketidaksesuaian'=>
                        $validated['ketidaksesuaian'][$i],
                        'tindakan_perbaikan'=>
                        $validated['tindakan_perbaikan'][$i],
                        'penanggung_jawab'=>$validated['penanggung_jawab'][$i],
                        'close_date'=>
                        $validated['close_date'][$i],
                    ],
                );
            
            }else{
                MonevSemester::create(
                    [
                        'report_id'=>$validated['report_id'],'object_name'=>$validated['object_name'][$i],'kesesuaian'=>$validated['kesesuaian'][$i],'ketidaksesuaian'=>
                        $validated['ketidaksesuaian'][$i],
                        'tindakan_perbaikan'=>
                        $validated['tindakan_perbaikan'][$i],
                        'penanggung_jawab'=>$validated['penanggung_jawab'][$i],
                        'close_date'=>
                        $validated['close_date'][$i],
                    ],
                );
                
            }

        
        }
            
       
      
        return redirect()->to(url('report/semester/'.$request->level_name))->with('success','Data berhasil disimpan');
        


    }


    public function downloadMonev(Request $request)
    {
        $validate=Validator::make(
            $request->all(),
            [
                'jenis_laporan'=>'required'
            ]
            );
        
        if($validate->fails()){
            return back()->withErrors($validate);
        }
        $id=$request->id;
        $report = SemesterReport::where('id',$id)->first();
        $monevs=MonevSemester::where('report_id',$id)->get();
       
        $data_template=[];
        $no=1;

        if($request->jenis_laporan=='monev'){
            foreach($monevs as $monev){
                $data_template[]=['no'=>$no++,'objek_monitoring'=>$monev->object_name, 'kesesuaian'=>$monev->kesesuaian,'ketidaksesuaian'=>$monev->ketidaksesuaian,'tindakan_perbaikan'=>$monev->tindakan_perbaikan,'penanggung_jawab'=>$monev->penanggung_jawab,'close_date'=>Carbon::parse($monev->close_date)->isoFormat('DD MMMM YYYY')];
            }
            $template = new TemplateProcessor(public_path('/template/template.docx'));
            $tanggalRead = Carbon::parse($report->report_date)->isoFormat('DD MMMM YYYY');
        }elseif($request->jenis_laporan=='tl'){
            foreach($monevs as $monev){
                $data_template[]=['no'=>$no++,'objek_monitoring'=>$monev->object_name, 'kesesuaian'=>$monev->kesesuaian,'ketidaksesuaian'=>$monev->ketidaksesuaian,'tindakan_perbaikan'=>$monev->tindakan_perbaikan,'penanggung_jawab'=>$monev->penanggung_jawab,'close_date'=>Carbon::parse($monev->close_date)->isoFormat('DD MMMM YYYY'),
                'tindak_lanjut'=>$monev->tindak_lanjut
            ];
            }
            $template = new TemplateProcessor(public_path('/template/template_tl.docx'));
            $tanggalRead = Carbon::parse($report->close_date)->isoFormat('DD MMMM YYYY');
        }
        

       

        $ketua=Pejabat::where('jabatan_id',1)->first();
        $wakil_ketua=Pejabat::where('jabatan_id',2)->first();
        if(!$ketua||!$wakil_ketua){
            return back()->with('fail','Atur pejabat terlebih dahulu!');
        }
       

        $template->setValue('title', $report->report_name);
        $template->setValue('tanggal_laporan', $tanggalRead);
        $template->setValue('nama_ketua', $ketua->nama);
        $template->setValue('nama_wakil_ketua', $wakil_ketua->nama);

        $template->cloneRowAndSetValues('no', $data_template);




        header("Content-Disposition: attachment; filename=Form-Laporan-Semester-" . time() . ".docx");
        $pathToSave = 'php://output';
        $template->saveAs($pathToSave);
        return;
    }

    public function addTl(Request $request,$report_id,$unit,$mode_tl=null){

       
        $monevs=MonevSemester::where('report_id',$report_id)->get();
        $unit_name=DB::table('level')->where('id',$unit)->first();
        return view('user.semester.tl_semester_view',['title'=>'Tambah TL Monev','bagian'=>$unit_name->unit,'report_id'=>$report_id,'monevs'=>$monevs,'mode'=>$mode_tl,'level_name'=>$unit_name->level_name]);
    }

    public function insertTl(Request $request){
        $validate=Validator::make($request->all(),
        [
           
            'tindak_lanjut.*'=>['required'],
           
            // 'file'=>['required','mimes:pdf','max:10000']
               
        ],
        
        );

        if($validate->fails()){
            return back()->withErrors($validate);
        }

        $validated=$validate->safe();

       $data_length=count($validated['tindak_lanjut']);
    //    dd($data_length);

        for($i=0;$i<$data_length;$i++){
            
                MonevSemester::where('id',$request->monev_id[$i])->update(
                    [
                    'tindak_lanjut'=>$validated['tindak_lanjut'][$i],
                    ],
                );

        
        }
            
       
      
        return redirect()->to(url('report/semester/perdata'))->with('success','Data berhasil disimpan');
        


    }

    public function upload(Request $request){
        $validate=Validator::make($request->all(),
        [
            
            'file'=>['required','mimes:pdf','max:10000']
               
        ]
        );

        if($validate->fails()){
            return back()->withErrors($validate);
        }

        $validated=$validate->validate();
        $report_data=SemesterReport::where('id',$request->report_id)->first();
            

        $report_name='SemesterReport-'.$request->level_id.'-'.$report_data->month.'-'.$report_data->year.'.'.$validated['file']->getClientOriginalExtension();

        $validated['file']->storeAs('semester_file',$report_name,'real_public');
        SemesterReport::where('id',$request->report_id)->update(
            [
            'file'=>$report_name
            ],
        );

        return redirect()->to(url('report/semester/perdata'))->with('success','File berhasil disimpan');
        
    }

    

}
