<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Traits\Common;

class ModalUpload extends Component
{
    use Common;
    public $show = false;
    public $report_id;
    public $data;
    public $periode;
 
    #[On('show-modal-upload')]
    public function showModal($id,$periode)
    {
       
        $this->report_id=$id;
        $this->periode=$periode;
        $this->show = true;
      
    }
 
    public function closeModal()
    {
 
        $this->data = "";
        $this->show = false;
    }
 
   
    public function render()
    {
        
                // $months=getMonthNames();
        return view('livewire.modal-upload',['periode_id'=>$this->periode,'report_id'=>$this->report_id]);
    }
}
