<?php

namespace App\Livewire;

use App\Models\WeeklyReport;
use App\Traits\Common;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalEditLaporanMingguan extends Component
{
    use Common;
    public $show = false;
    public $id;
    public $data;
 
    #[On('show-modal-edit-laporan-mingguan')]
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
        $report_data=WeeklyReport::with(['reportName'])->where('id',$id)->first();
        $report_refs=DB::table('report_ref')->where('level_id',$report_data?->reportName?->level_id)->where('periode','mingguan')->get();
        return view('livewire.modal-edit-laporan-mingguan',['report_data'=>$report_data,'report_refs'=>$report_refs,'months'=>$this->getMonthNames(),'years'=>$this->getYearArray()]);
    }
}
