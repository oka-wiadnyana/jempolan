<?php

namespace App\Livewire;

use App\Models\WeeklyReport;
use App\Traits\Common;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalDetailLaporanMingguan extends Component
{
    use Common;
    public $show = false;
    public $id;
    public $data;
 
    #[On('show-modal-detail-laporan-mingguan')]
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

        $months=$this->getMonthNames();
        $monthsKey=collect($months)->mapWithKeys(function (array $item, int $key) {
            return [$item['month_number'] => $item['month_name']];
        })->all();
       
        return view('livewire.modal-detail-laporan-mingguan',['report_data'=>$report_data,'months'=>$monthsKey]);
    }
}
