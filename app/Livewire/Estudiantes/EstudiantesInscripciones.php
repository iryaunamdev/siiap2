<?php

namespace App\Livewire\Estudiantes;

use App\Models\Tutor;
use Livewire\Component;
use App\Models\sys\CatalogoItem;
use Livewire\Attributes\Validate;
use App\Models\EstudianteInscripcion;
use App\Models\EstudianteTutor;

class EstudiantesInscripciones extends Component
{
    public $estudiante, $ingreso, $grado, $old_semestre_id, $card_title, $copy;

    public $inscripciones, $inscripcion, $inscripcion_id;

    #[Validate('required')]
    public $semestre_id, $adscripcion_id;

    public $tutor_id, $is_principal = false;

    public $showEditModal = false, $showCTModal = false, $deleteModal = false, $delete_inscripcion=false, $to_delete;

    //Catalogos
    public $c_semestres, $c_adscripciones, $c_tutores;


    public function render()
    {
        return view('livewire.estudiantes.estudiantes-inscripciones');
    }

    public function mount()
    {
        $this->c_semestres = CatalogoItem::whereRelation('catalogo', 'clave', 'SEM')->get()->sortByDesc('nombre');
        $this->c_adscripciones = CatalogoItem::whereRelation('catalogo', 'clave', 'ADSC')->get()->sortBy('nombre');
        $this->c_tutores = Tutor::where('activo', true)->get()->sortBy('fullname');
    }

    public function editInscripcion(EstudianteInscripcion $inscripcion, $copy=false)
    {
        if (isset($inscripcion->id)) {
            $this->inscripcion = $inscripcion;
            $this->inscripcion_id = $inscripcion->id;
            $this->ingreso = $inscripcion->ingreso;
            $this->semestre_id = $inscripcion->semestre_id;
            $this->old_semestre_id = $inscripcion->semestre->id;
            $this->adscripcion_id = $inscripcion->adscripcion_id;

            $this->card_title = "Modificar datos de inscripción";

            $this->showEditModal = True;
        } else {
            if ($this->grado) {
                //Inscripcion de maestría
                if (isset($this->estudiante->ingreso_m)) {
                    $this->ingreso = $this->estudiante->ingreso_m;
                    $this->card_title = "Agregar inscripción (Maestría)";
                    $this->showEditModal = True;
                } else {
                    $this->notify('Es necesario que el usuario tenga un registro de ingreso a maestría', 'Sin registro de ingreso', 'error');
                }
            } else {
                //Inscripcion de doctorado
                if (isset($this->estudiante->ingreso_d)) {
                    $this->ingreso = $this->estudiante->ingreso_d;
                    $this->card_title = "Agregar inscripción (Doctorado)";
                    $this->showEditModal = True;
                } else {
                    $this->notify('Es necesario que el usuario tenga un registro de ingreso a doctorado', 'Sin registro de ingreso', 'error');
                }
            }
        }

        if($this->grado){
            $this->inscripciones = isset($this->estudiante->inscripciones_m) ? $this->estudiante->inscripciones_m : null;
        }else{
            $this->inscripciones = isset($this->estudiante->inscripciones_d) ? $this->estudiante->inscripciones_d : null;
        }

        if($copy){
            $this->card_title = "Duplicar inscripción";
            $this->inscripcion_id =  null;
            $this->copy = True;
        }
    }

    public function store()
    {
        $this->validate();
        //Verificar que el semestre no se repita al crear, al menos que se trate de un update y quede el mismo semestre.
        if ($this->noRepeatSemestre() OR !$this->changeOnSemestre()) {
            $inscripcion = EstudianteInscripcion::updateOrCreate(
                [
                    'id' => $this->inscripcion_id,
                ],
                [
                    'estudiante_id' => $this->estudiante->id,
                    'ingreso_id' => $this->ingreso->id,
                    'semestre_id' => $this->semestre_id,
                    'adscripcion_id' => $this->adscripcion_id,

                    'grado_id' => $this->ingreso->grado_id,
                    'programa_id' => $this->ingreso->programa_id,
                ]
            );

            if($this->copy AND $inscripcion->wasRecentlyCreated){
                //Copiar comité tutor en registro copiado
                foreach($this->inscripcion->comite as $ct){
                    EstudianteTutor::create([
                        'estudiante_id' => $inscripcion->estudiante_id,
                        'inscripcion_id' => $inscripcion->id,
                        'tutor_id' => $ct->tutor_id,
                        'principal' => $ct->principal ? true : false,
                    ]);
                }
                $this->notify("","Se realizó una copia del registro","info");
                $this->closeModal();
            }else{
                if ($inscripcion->wasRecentlyCreated) {
                    $this->notify('El registro se creó corectamente', 'Registro creado', 'success');
                } else {
                    $this->notify('', 'Registro actualizado', 'info');
                }
                $this->closeModal();
            }
        } else {
            $this->notify("No es posible tener mas de una inscripción por semestre.", "Registro duplicado", "error");
        }
    }

    public function addCT($inscripcion_id = null){
        if($inscripcion_id){
            $this->showCTModal =  true;
            $this->inscripcion_id = $inscripcion_id;
        }else{
            $this->notify('No se reconocen los datos de inscripción','ERROR','error');
        }
    }

    function storeCT(){
        $this->validate([
            'tutor_id'=>'required',
        ]);

        $ct = EstudianteTutor::updateOrCreate(
            [
                'inscripcion_id' => $this->inscripcion_id,
                'estudiante_id' => $this->estudiante->id,
                'tutor_id' => $this->tutor_id,
            ],
            [
                'estudiante_id' => $this->estudiante->id,
                'inscripcion_id' => $this->inscripcion_id,
                'tutor_id' => $this->tutor_id,
                'principal' => $this->is_principal ? true : false,
            ]
        );

        if ($ct->wasRecentlyCreated) {
            $this->notify('El registro se creó corectamente', 'Registro creado', 'success');
        } else {
            $this->notify('', 'Registro actualizado', 'info');
        }

        $this->closeModal();
    }

    public function closeModal()
    {
        $this->showEditModal = false;
        $this->showCTModal = false;
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset([
            'semestre_id',
            'adscripcion_id',
            'ingreso',
            'inscripciones',
            'old_semestre_id',
            'inscripcion_id',
            'tutor_id',
            'is_principal',
            'copy',
        ]);
        $this->mount();
    }

    public function deleteInscripcion(EstudianteInscripcion $inscripcion){
        $this->delete_inscripcion = true;
        $this->to_delete = $inscripcion;
        $this->deleteModal = true;
    }

    public function deleteCT(EstudianteTutor $ct){
        $this->deleteModal = True;
        $this->to_delete = $ct;
    }

    public function delete(){
        if($this->delete_inscripcion){
            //Eliminar comite tutor de la inscripción
            foreach($this->to_delete->comite as $ct){
                $ct->delete();
            }
        }
        $this->to_delete->delete();
        $this->deleteModal = false;
        $this->notify("El registro se eliminó de manera permanente.", "Registro eliminado", "error");
        $this->reset(['to_delete']);
        $this->mount();
    }

    public function changeOnSemestre(){
        if($this->semestre_id == $this->old_semestre_id){
            return False;
        }
        return True;
    }

    public function noRepeatSemestre()
    {
        foreach ($this->inscripciones as $i) {
            if ($i->semestre_id == $this->semestre_id) {
                return false;
            }
        }

        return True;
    }
}
