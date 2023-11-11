<?php

namespace App\Livewire;

use App\Models\Level;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;


class ModalAddAkun extends Component
{
   
    public $show = false;
    
    public $data;
 
    #[On('show-modal-tambah-akun')]
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
        
        $levels=Level::all();
        // $months=getMonthNames();
        return view('livewire.modal-add-akun',['levels'=>$levels]);
    }
}
