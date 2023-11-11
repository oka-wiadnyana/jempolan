<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalAddReport extends Component
{
    public $show = false;
   
    public $data;
 
    #[On('show-modal-tambah-laporan')]
    public function showModal()
    {
 
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
        return view('livewire.modal-add-report',['levels'=>$levels]);
    }
}
