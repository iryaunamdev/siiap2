<?php

namespace App\Livewire\Clases;

use App\Models\Clase;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class ClasesIndex extends Component
{
    protected $authorizedRoles = [
        'admin', 'editor'
    ];

    public $deleteModal=False, $to_delete;

    public function render()
    {
        if(Auth::user()->hasanyrole($this->authorizedRoles)){
            return view('livewire.clases.clases-index');
        }else{
            return abort('403', 'Usuario no autorizado');
        }
    }

    #[On('confirm-delete-clase')]
    public function deleteEstudiante(Clase $clase = null){
        $this->to_delete = $clase;
        $this->deleteModal = True;
    }

    public function delete(){
        $this->to_delete->delete();
        $this->deleteModal = false;
        $this->js('window.location.reload()');
        $this->notify('El registro se eliminó de manera permanente.', '', 'error');

    }
}
