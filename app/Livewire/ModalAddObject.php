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
 
    #[On('show-modal-tambah-object')]
    public function showModal($periode)
    {
 
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
        // $periodes=DB::table('periode_ref')->get();

        return view('livewire.modal-add-object',['levels'=>$levels,'periode'=>$this->periode]);
    }
}
