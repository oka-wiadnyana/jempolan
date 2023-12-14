<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalAddReport extends Component
{
    public $show = false;
    public $levelName;
   
    public $data;
 
    #[On('show-modal-tambah-laporan')]
    public function showModal($levelName)
    {
 
        $this->show = true;
        $this->levelName = $levelName;
       
      
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
        $levelId=DB::table('level')->where('level_name',$this->levelName)->first();

        return view('livewire.modal-add-report',['levels'=>$levels,'periodes'=>$periodes,'levelId'=>$levelId]);
    }
}
