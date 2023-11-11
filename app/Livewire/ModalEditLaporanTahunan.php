<?php

namespace App\Livewire;

use App\Models\MonthlyReport;
use App\Models\QuarterlyReport;
use App\Models\SemesterReport;
use App\Models\WeeklyReport;
use App\Models\YearlyReport;
use App\Traits\Common;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalEditLaporanTahunan extends Component
{
    use Common;
    public $show = false;
    public $id;
    public $data;
 
    #[On('show-modal-edit-laporan-tahunan')]
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
        $report_data=YearlyReport::with(['reportName'])->where('id',$id)->first();
        $report_refs=DB::table('report_ref')->where('level_id',$report_data?->reportName?->level_id)->where('periode','tahunan')->get();
        return view('livewire.modal-edit-laporan-tahunan',['report_data'=>$report_data,'report_refs'=>$report_refs,'years'=>$this->getYearArray()]);
    }
}
