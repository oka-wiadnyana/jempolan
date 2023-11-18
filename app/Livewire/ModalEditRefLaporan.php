<?php

namespace App\Livewire;

use App\Models\ReportRef;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalEditRefLaporan extends Component
{
    public $show = false;
    public $id;
    public $data;
 
    #[On('show-modal-edit-ref-laporan')]
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
        $levels=DB::table('level')->get();
        $periodes=DB::table('periode_ref')->get();
        $report=ReportRef::find($this->id);
     
        return view('livewire.modal-edit-ref-laporan',['report'=>$report,'levels'=>$levels,'periodes'=>$periodes]);
    }
}
