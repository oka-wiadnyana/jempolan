<?php

namespace App\Livewire;

use App\Models\ObjectMonev;
use App\Models\ObjectMonevQuarterly;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalEditObject extends Component
{
    public $show = false;
    public $unit='';
    public $reports;
    public $data;
    public $periode;
    public $id;
    public $object_report;
 
    #[On('show-modal-edit-object')]
    public function showModal($id,$periode)
    {
 
        $this->id = $id;
        $this->periode = $periode;
        $this->show = true;
      
    }
 
    public function closeModal()
    {
 
        $this->data = "";
        $this->show = false;
    }
 
   public function updatedUnit(){
    $periode=DB::table('periode_ref')->where('periode_name',$this->periode)->first();
    $this->reports=DB::table('report_ref')->where('level_id',$this->unit)->where('periode',$periode->id)->get();
    // dd($this->unit);
   }


    public function render()
    {
       
        $levels=DB::table('level')->get();
        if($this->periode=='bulanan'){
            $this->object_report=ObjectMonev::where('id',$this->id)->first();
        }elseif($this->periode=='triwulan'){
            $this->object_report=ObjectMonevQuarterly::where('id',$this->id)->first();
        }else {
            $this->object_report;
        }
        $periode=DB::table('periode_ref')->where('periode_name',$this->periode)->first();
        $this->reports=DB::table('report_ref')->where('level_id',$this->object_report?->reportName->level_id)->where('periode',$periode?->id)->get();
        
        return view('livewire.modal-edit-object',['levels'=>$levels,'periode_id'=>$periode?->id,'object_id'=>$this->id,'object_report'=>$this->object_report,'all_reports'=>$this->reports]);
    }
}
