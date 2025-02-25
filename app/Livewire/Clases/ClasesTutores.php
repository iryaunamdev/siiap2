<?php

namespace App\Livewire\Clases;

use App\Models\ClaseTutor;
use App\Models\Tutor;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ClasesTutores extends Component
{
    public $clase, $clase_id, $ct, $principal, $update, $card_title;
    #[Validate('required', message:'Campo obligatorio')]
    public $tutor_id;

    public $c_tutores;
    public $showTutorModal = false, $deleteModal=false, $to_delete;

    public function render()
    {
        return view('livewire.clases.clases-tutores');
    }

    public function mount(){
        $this->c_tutores = Tutor::all()->sortBy('fullname');
    }

    public function edit(ClaseTutor $ct){
        if($ct->id){
            $this->ct = $ct;
            $this->tutor_id = $this->ct->tutor_id;
            $this->principal = $this->ct->principal ? True : False;
            $this->update = True;
            $this->card_title = "Modificar datos de Tutor";
        }else{
            $this->update = False;
            $this->card_title = "Agregar Tutor";
        }
        $this->clase_id = $this->clase->id;
        $this->showTutorModal = true;
    }

    public function store(){
        $this->validate();

        $ct = ClaseTutor::updateOrCreate(
            [
                'clase_id'=>$this->clase_id,
                'tutor_id'=>$this->tutor_id,
            ],
            [
                'clase_id'=>$this->clase_id,
                'tutor_id'=>$this->tutor_id,
                'principal' => $this->principal,
            ]
        );
        if ($ct->wasRecentlyCreated) {
            $this->notify('El registro se creó corectamente', 'Registro creado', 'success');
        } else {
            $this->notify('', 'Registro actualizado', 'info');
        }

        $this->closeModal();
    }

    public function deleteTutor(ClaseTutor $tutor){
        $this->to_delete = $tutor;
        $this->deleteModal = True;
    }

    public function delete(){
        $this->to_delete->delete();
        $this->deleteModal=false;

        $this->notify("El registro se eliminó de manera permanente.", "Registro eliminado", "error");
        $this->reset(['to_delete']);
        $this->mount();
    }

    public function closeModal(){
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset([
            'clase_id',
            'tutor_id',
            'principal',
        ]);

        $this->showTutorModal = false;
        $this->mount();
    }
}
