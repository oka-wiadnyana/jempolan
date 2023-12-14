<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalAddObject extends Component
{
    public $show = false;
    public $unit='';
    public $reports;
    public $data;
    public $periode;
    public $levelName;
 

    #[On('show-modal-tambah-object')]
    public function showModal($periode,$levelName)
    {
 
        $this->periode = $periode;
        $this->levelName = $levelName;
        $periode=DB::table('periode_ref')->where('periode_name',$this->periode)->first();
        $levelName=DB::table('level')->where('level_name',$this->levelName)->first();
        // dd($levelName->id,$periode);
        if($levelName){
            $this->reports=DB::table('report_ref')->where('level_id',$levelName->id)->where('periode',$periode->id)->get();
        }
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
        // $periodes=DB::table('periode_ref')->get();
        

        return view('livewire.modal-add-object',['levels'=>$levels,'periode'=>$this->periode,'levelName'=>$this->levelName]);
    }
}
