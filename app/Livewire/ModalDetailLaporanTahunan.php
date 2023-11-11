<?php

namespace App\Livewire;

use App\Models\MonthlyReport;
use App\Models\QuarterlyReport;
use App\Models\SemesterReport;
use App\Models\WeeklyReport;
use App\Models\YearlyReport;
use App\Traits\Common;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalDetailLaporanTahunan extends Component
{
    use Common;
    public $show = false;
    public $id;
    public $data;
 
    #[On('show-modal-detail-laporan-tahunan')]
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

             
        return view('livewire.modal-detail-laporan-tahunan',['report_data'=>$report_data]);
    }
}
