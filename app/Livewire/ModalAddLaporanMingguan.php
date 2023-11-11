<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Traits\Common;

class ModalAddLaporanMingguan extends Component
{
    use Common;
    public $show = false;
    public $unit;
    public $data;
 
    #[On('show-modal-tambah-laporan-mingguan')]
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
        
        $report_refs=DB::table('report_ref')->where('level_id',$this->unit)->where('periode','mingguan')->get();
        // $months=getMonthNames();
        return view('livewire.modal-add-laporan-mingguan',['unit'=>$this->unit,'report_refs'=>$report_refs,'months'=>$this->getMonthNames(),'years'=>$this->getYearArray()]);
    }
}
