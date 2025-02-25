<?php

namespace App\Livewire\Clases;

use App\Models\ClaseEstudiante;
use App\Models\Estudiante;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ClasesEstudiantes extends Component
{
    public $clase, $clase_id, $card_title, $update=false;

    #[Validate('required', message:'Campo obligatorio')]
    public $estudiante_id;
    public $clase_estudiante, $calificacion, $acreditada;

    public $c_estudiantes;

    public $showEstudianteModal = false, $deleteModal=false, $to_delete;

    public function render()
    {
        return view('livewire.clases.clases-estudiantes');
    }

    public function mount(){
        $this->c_estudiantes= Estudiante::all()->sortBy('fullname');
    }

    public function edit(ClaseEstudiante $ce = null){
        if($ce->id){
            $this->clase_estudiante = $ce;
            $this->estudiante_id = $this->clase_estudiante->estudiante_id;
            $this->calificacion = $this->clase_estudiante->calificacion;
            $this->acreditada = $this->clase_estudiante->acreditada;
            $this->card_title = "Modificar datos de estudiante";
            $this->update = True;
        }else{
            $this->card_title = "Agregar estudiante";
            $this->update = false;
        }
        $this->clase_id = $this->clase->id;
        $this->showEstudianteModal = true;
    }

    public function store(){
        $this->validate();
        $ce = ClaseEstudiante::updateOrCreate(
            [
                'clase_id'=>$this->clase_id,
                'estudiante_id'=>$this->estudiante_id,
            ],
            [
                'clase_id'=>$this->clase_id,
                'estudiante_id'=>$this->estudiante_id,
                'calificacion' => $this->calificacion,
                'acreditada' => $this->acreditada,
            ]
        );

        if ($ce->wasRecentlyCreated) {
            $this->notify('El registro se creó corectamente', 'Registro creado', 'success');
        } else {
            $this->notify('', 'Registro actualizado', 'info');
        }

        $this->closeModal();
    }

    public function deleteEstudiante(ClaseEstudiante $estudiante){
        $this->to_delete = $estudiante;
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
            'estudiante_id',
            'calificacion',
            'acreditada',
        ]);

        $this->showEstudianteModal = false;
        $this->mount();
    }
}
