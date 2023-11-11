<?php

namespace App\Livewire;

use App\Models\MonthlyReport;
use App\Models\WeeklyReport;
use App\Traits\Common;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalEditLaporanBulanan extends Component
{
    use Common;
    public $show = false;
    public $id;
    public $data;
 
    #[On('show-modal-edit-laporan-bulanan')]
    public function showModal($id)
    {
       
        $this->id=$id;
        $this->show = true;
      
    }
 
    public function closeModal()
    {
 
        $this->data = "";
        $this->show = false;
    }
 
    public function render()
    {
        $id=$this->id;
        $report_data=MonthlyReport::with(['reportName'])->where('id',$id)->first();
        $report_refs=DB::table('report_ref')->where('level_id',$report_data?->reportName?->level_id)->where('periode','bulanan')->get();
        return view('livewire.modal-edit-laporan-bulanan',['report_data'=>$report_data,'report_refs'=>$report_refs,'months'=>$this->getMonthNames(),'years'=>$this->getYearArray()]);
    }
}
