<?php

namespace App\Livewire;

use App\Models\Level;
use App\Models\Pejabat;
use App\Models\RefJabatan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;


class ModalEditPejabat extends Component
{
   
    public $show = false;
    public $id;
    public $data;
 
    #[On('show-modal-edit-pejabat')]
    public function showModal($id)
    {
       
       $this->id = $id;
       $this->show = true;
      
    }
 
    public function closeModal()
    {
 
      
        $this->show = false;
    }
 
   
    public function render()
    {
        
        $jabatans=RefJabatan::all();
        $pejabat=Pejabat::where('id',$this->id)->first();
        return view('livewire.modal-edit-pejabat',['jabatans'=>$jabatans,'pejabat'=>$pejabat]);
    }
}
