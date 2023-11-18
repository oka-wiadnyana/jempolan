<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Traits\Common;

class ModalAddLaporanBulanan extends Component
{
    use Common;
    public $show = false;
    public $level_id;
    public $data;
 
    #[On('show-modal-tambah-laporan-bulanan')]
    public function showModal($unit)
    {
       
        $this->level_id=$unit;
        $this->show = true;
      
    }
 
    public function closeModal()
    {
 
        $this->data = "";
        $this->show = false;
    }
 
   
    public function render()
    {
        
        $report_refs=DB::table('report_ref')->where('level_id',$this->level_id)->where('periode',2)->get();
        

        // $months=getMonthNames();
        return view('livewire.modal-add-laporan-bulanan',['level_id'=>$this->level_id,'report_refs'=>$report_refs,'periode_id'=>2,'months'=>$this->getMonthNames(),'years'=>$this->getYearArray()]);
    }
}
