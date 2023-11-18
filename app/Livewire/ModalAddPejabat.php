<?php

namespace App\Livewire;

use App\Models\Level;
use App\Models\RefJabatan;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;


class ModalAddPejabat extends Component
{
   
    public $show = false;
    
    public $data;
 
    #[On('show-modal-tambah-pejabat')]
    public function showModal()
    {
       
       $this->show = true;
      
    }
 
    public function closeModal()
    {
 
      
        $this->show = false;
    }
 
   
    public function render()
    {
        
        $jabatans=RefJabatan::all();
        // $months=getMonthNames();
        return view('livewire.modal-add-pejabat',['jabatans'=>$jabatans]);
    }
}
