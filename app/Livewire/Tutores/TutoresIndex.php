<?php

namespace App\Livewire\Tutores;

use App\Models\Tutor;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class TutoresIndex extends Component
{

    protected $authorizedRoles = [
        'admin', 'editor'
    ];

    public $deleteModal=False, $to_delete;

    public function render()
    {
        if(Auth::user()->hasanyrole($this->authorizedRoles)){
            return view('livewire.tutores.tutores-index');
        }else{
            return abort('403', 'Usuario no autorizado');
        }
    }

    #[On('confirm-delete-tutor')]
    public function deleteTutor(Tutor $tutor = null){
        $this->to_delete = $tutor;
        $this->deleteModal = True;
    }

    public function delete(){
        $this->to_delete->delete();
        $this->deleteModal = false;
        $this->js('window.location.reload()');
        $this->notify('El registro se eliminó de manera permanente.', '', 'error');

    }
}
