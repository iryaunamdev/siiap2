<?php

namespace App\Livewire\Estudiantes;

use App\Models\EstudianteSeguimiento;
use App\Models\EstudianteSeguimientoTutor;
use App\Models\sys\CatalogoItem;
use App\Models\Tutor;
use Livewire\Component;
use Livewire\Attributes\Validate;

class EstudiantesSeguimientos extends Component
{
    #[Validate('required', message:'Campo requerido')]
    public $tipo_id, $fecha;

    public $estudiante, $card_title;
    public $seguimiento, $seguimiento_id, $titulo, $estatus_id, $comentarios, $bibcode, $doi;
    public $tutor_id;
    public $c_tipos, $c_estatus, $c_tutores;

    public $showSeguimientosModal = false, $showSinodalModal=false, $deleteModal=false, $to_delete, $delete_seguimiento = false;

    public function render()
    {
        return view('livewire.estudiantes.estudiantes-seguimientos');
    }

    public function mount(){
        $this->c_tipos = CatalogoItem::whereRelation('catalogo', 'clave', 'TSEG')->where('activo', true)->get()->sortBy('nombre');
        $this->c_estatus = CatalogoItem::whereRelation('catalogo', 'clave', 'ESTSEG')->where('activo', true)->get()->sortBy('nombre');
        $this->c_tutores = Tutor::where('activo', true)->get()->sortBy('fullname');
    }

    public function editSeguimiento(EstudianteSeguimiento $seguimiento = null){
        if($seguimiento->id){
            $this->seguimiento = $seguimiento;
            $this->seguimiento_id = $seguimiento->id;
            $this->tipo_id = $seguimiento->tipo_id;
            $this->fecha = $seguimiento->fecha ? $seguimiento->fecha->format('Y-m-d') : null ;
            $this->titulo = $seguimiento->titulo;
            $this->estatus_id = $seguimiento->estatus_id;
            $this->comentarios = $seguimiento->comentarios;
            $this->bibcode = $seguimiento->bibcode;
            $this->doi = $seguimiento->doi;

            $this->card_title = "Modificar datos de seguimiento";
        }else{
            $this->card_title = "Agregar nuevo seguimiento";
        }

        $this->showSeguimientosModal =  True;
    }

    public function store(){
        $this->validate();
        $seguimiento = EstudianteSeguimiento::updateOrCreate(
            [
                'id'=>$this->seguimiento_id,
            ],
            [
                'estudiante_id'=>$this->estudiante->id,
                'tipo_id' => $this->tipo_id,
                'fecha'=>$this->fecha,
                'titulo'=>$this->titulo,
                'estatus_id'=>$this->estatus_id,
                'comentarios'=>$this->comentarios,
                'bibcode'=>$this->bibcode,
                'doi'=>$this->doi,
            ]
        );
        if ($seguimiento->wasRecentlyCreated) {
            $this->notify('El registro se creó corectamente', 'Registro creado', 'success');
        } else {
            $this->notify('', 'Registro actualizado', 'info');
        }
        $this->closeModal();
    }

    public function addSinodal($seguimiento_id = null){
        $this->seguimiento_id = $seguimiento_id;
        $this->showSinodalModal = true;
    }

    public function storeSinodal(){
        $seguimiento = EstudianteSeguimientoTutor::updateOrCreate(
            [
                'seguimiento_id' => $this->seguimiento_id,
                'tutor_id' => $this->tutor_id,
            ],
            [
                'seguimiento_id' => $this->seguimiento_id,
                'tutor_id' => $this->tutor_id
            ]
        );

        if ($seguimiento->wasRecentlyCreated) {
            $this->notify('El registro se creó corectamente', 'Registro creado', 'success');
        } else {
            $this->notify('', 'Registro actualizado', 'info');
        }
        $this->closeModal();
    }

    public function deleteSeguimiento(EstudianteSeguimiento $seguimiento){
        $this->to_delete = $seguimiento;
        $this->delete_seguimiento = true;
        $this->deleteModal =true;
    }

    public function deleteSinodal(EstudianteSeguimientoTutor $sinodal){
        $this->to_delete = $sinodal;
        $this->delete_seguimiento = false;
        $this->deleteModal =true;
    }

    public function delete(){
        if($this->delete_seguimiento){
            foreach($this->to_delete->sinodales as $sinodal){
                $sinodal->delete();
            }
        }
        $this->to_delete->delete();
        $this->reset([
            'delete_seguimiento',
            'to_delete',
        ]);
        $this->deleteModal = false;
        $this->notify("El registro se eliminó de manera permanente.", "Registro eliminado", "error");
    }

    public function closeModal(){
        $this->showSeguimientosModal = False;
        $this->showSinodalModal = False;
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset([
            'seguimiento_id',
            'tipo_id',
            'estatus_id',
            'fecha',
            'titulo',

            'comentarios',
            'bibcode',
            'doi',

            'tutor_id',
        ]);
        $this->mount();
    }
}
