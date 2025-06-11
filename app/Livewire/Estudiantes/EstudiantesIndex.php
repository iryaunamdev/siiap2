<?php

namespace App\Livewire\Estudiantes;

use Livewire\Component;
use App\Models\Estudiante;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class EstudiantesIndex extends Component
{
    protected $authorizedRoles = [
        'admin', 'editor'
    ];

    public $deleteModal=False, $to_delete;

    public function render()
    {
        if(Auth::user()->hasanyrole($this->authorizedRoles)){
            return view('livewire.estudiantes.estudiantes-index');
        }else{
            return abort('403', 'Usuario no autorizado');
        }
    }

    public function mount(){

    }

    #[On('confirm-delete-estudiante')]
    public function deleteEstudiante(Estudiante $estudiante = null){
        $this->to_delete = $estudiante;
        $this->deleteModal = True;
    }

    public function delete(){
        $this->to_delete->delete();
        $this->deleteModal = false;
        $this->js('window.location.reload()');
        $this->notify('El registro se eliminó de manera permanente.', '', 'error');

    }
}
