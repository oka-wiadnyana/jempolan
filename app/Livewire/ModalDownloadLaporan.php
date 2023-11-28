<?php

namespace App\Livewire;

use App\Models\Level;
use App\Models\Pejabat;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;


class ModalDownloadLaporan extends Component
{
   
    public $show = false;
    public $periode;
    public $data;
    public $id;
 
    #[On('show-modal-download-laporan')]
    public function showModal($id,$periode)
    {
       $this->id=$id;
       $this->periode=$periode;
    //    dd($this->periode);
       $this->show = true;
      
    }
 
    public function closeModal()
    {
 
      
        $this->show = false;
    }
 
   
    public function render()
    {
        
        $levels=Level::all();
        $pejabats=Pejabat::all();
        // $months=getMonthNames();
        return view('livewire.modal-download-laporan',['id'=>$this->id,'periode'=>$this->periode,'pejabats'=>$pejabats]);
    }
}
