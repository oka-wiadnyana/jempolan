<?php

namespace App\Livewire;

use App\Models\MonthlyReport;
use App\Models\QuarterlyReport;
use App\Models\WeeklyReport;
use App\Traits\Common;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalEditLaporanTriwulan extends Component
{
    use Common;
    public $show = false;
    public $id;
    public $data;
 
    #[On('show-modal-edit-laporan-triwulan')]
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
        $report_data=QuarterlyReport::with(['reportName'])->where('id',$id)->first();
        $report_refs=DB::table('report_ref')->where('level_id',$report_data?->reportName?->level_id)->where('periode','triwulan')->get();
        return view('livewire.modal-edit-laporan-triwulan',['report_data'=>$report_data,'report_refs'=>$report_refs,'years'=>$this->getYearArray()]);
    }
}
