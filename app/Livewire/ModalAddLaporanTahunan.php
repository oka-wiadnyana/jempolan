<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Traits\Common;

class ModalAddLaporanTahunan extends Component
{
    use Common;
    public $show = false;
    public $unit;
    public $data;
 
    #[On('show-modal-tambah-laporan-tahunan')]
    public function showModal($unit)
    {
       
        $this->unit=$unit;
        $this->show = true;
      
    }
 
    public function closeModal()
    {
 
        $this->data = "";
        $this->show = false;
    }
 
   
    public function render()
    {
        
        $report_refs=DB::table('report_ref')->where('level_id',$this->unit)->where('periode','tahunan')->get();
        // $months=getMonthNames();
        return view('livewire.modal-add-laporan-tahunan',['unit'=>$this->unit,'report_refs'=>$report_refs,'years'=>$this->getYearArray()]);
    }
}
