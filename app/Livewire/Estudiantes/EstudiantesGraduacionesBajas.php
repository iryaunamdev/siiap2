<?php

namespace App\Livewire\Estudiantes;

use App\Models\EstudianteBaja;
use App\Models\EstudianteGraduacion;
use App\Models\EstudianteGraduacionTutor;
use App\Models\Tutor;
use Livewire\Component;
use App\Models\sys\CatalogoItem;
use Livewire\Attributes\Validate;

class EstudiantesGraduacionesBajas extends Component
{
    public $estudiante, $grado, $card_title;

    #[Validate('required', message:'Campo requerido')]
    public $grado_id, $semestre_id, $ingreso_id;

    public $modalidad_id, $adscripcion_id, $fecha, $titulo;
    public $tipo_id, $motivo_id;
    public $tutor_id, $graduacion_id;

    public $c_semestres, $c_modalidades, $c_adscripciones, $c_tutores, $c_grados, $c_tipos_bajas, $c_motivos;
    public $showEditModal = False, $showBajaModal = False, $showSinodalModal=false, $deleteModal=False, $to_delete, $delete_graduacion = false;

    public function render()
    {
        return view('livewire.estudiantes.estudiantes-graduaciones-bajas');
    }

    public function mount(){
        $this->c_semestres = CatalogoItem::whereRelation('catalogo', 'clave', 'SEM')->get()->sortByDesc('nombre');
        $this->c_modalidades = CatalogoItem::whereRelation('catalogo', 'clave', 'MGRAD')->get()->sortByDesc('nombre');
        $this->c_tutores = Tutor::all()->sortBy('apellidop');
        $this->c_grados = CatalogoItem::where('clave', 'MAE')->orWhere('clave', 'DOC')->get();
        $this->c_adscripciones = CatalogoItem::whereRelation('catalogo', 'clave', 'ADSC')->get()->sortBy('nombre');

        $this->c_tipos_bajas = CatalogoItem::whereRelation('catalogo', 'clave', 'TBAJAS')->get()->sortBy('nombre');
        $this->c_motivos = CatalogoItem::whereRelation('catalogo', 'clave', 'MBAJA')->get()->sortBy('nombre');
    }

    public function editGraduacion(EstudianteGraduacion $graduacion = null){
        if(isset($graduacion->id)){
            $this->modalidad_id = $graduacion->modalidad_id;
            $this->adscripcion_id = $graduacion->adscripcion_id;
            $this->semestre_id = $graduacion->semestre_id;
            $this->fecha = $graduacion->fecha ? $graduacion->fecha->format('Y-m-d'):null;
            $this->titulo = $graduacion->titulo;
            $this->grado_id = $graduacion->grado_id;
            $this->ingreso_id = $graduacion->ingreso_id;

            $this->card_title = "Modificar datos de graduación (".$graduacion->grado->nombre.")";
            $this->showEditModal = true;
        }else{
            if ($this->grado) {
                //Maestría
                if (isset($this->estudiante->ingreso_m)) {
                    $this->grado_id = CatalogoItem::where('clave', 'MAE')->first()->id;
                    $this->ingreso_id = $this->estudiante->ingreso_m->id;

                    $this->card_title = "Agregar datos de graduación (Maestría)";
                    $this->showEditModal = True;
                } else {
                    $this->notify('Es necesario que el usuario tenga un registro de ingreso a maestría', 'Sin registro de ingreso', 'error');
                }
            } else {
                //Doctorado
                if (isset($this->estudiante->ingreso_d)) {
                    $this->grado_id = CatalogoItem::where('clave', 'DOC')->first()->id;
                    $this->ingreso_id = $this->estudiante->ingreso_d->id;

                    $this->card_title = "Agregar datos de graduación (Doctorado)";
                    $this->showEditModal = True;
                } else {
                    $this->notify('Es necesario que el usuario tenga un registro de ingreso a doctorado', 'Sin registro de ingreso', 'error');
                }
            }

        }
    }

    public function editBaja(EstudianteBaja $baja = null) {
        if(isset($baja->id)){
            $this->tipo_id = $baja->tipo_id;
            $this->motivo_id = $baja->motivo_id;
            $this->semestre_id = $baja->semestre_id;
            $this->fecha = $baja->fecha ? $baja->fecha->format('Y-m-d'):null;

            $this->grado_id = $baja->grado_id;
            $this->ingreso_id = $baja->ingreso_id;

            $this->card_title = "Modificar datos de baja (".$baja->grado->nombre.")";
            $this->showBajaModal = true;
        }else{
            if ($this->grado) {
                //Maestría
                if (isset($this->estudiante->ingreso_m)) {
                    $this->grado_id = CatalogoItem::where('clave', 'MAE')->first()->id;
                    $this->ingreso_id = $this->estudiante->ingreso_m->id;

                    $this->card_title = "Agregar datos de baja (Maestría)";
                    $this->showBajaModal = True;
                } else {
                    $this->notify('Es necesario que el usuario tenga un registro de ingreso a maestría', 'Sin registro de ingreso', 'error');
                }
            } else {
                //Doctorado
                if (isset($this->estudiante->ingreso_d)) {
                    $this->grado_id = CatalogoItem::where('clave', 'DOC')->first()->id;
                    $this->ingreso_id = $this->estudiante->ingreso_d->id;

                    $this->card_title = "Agregar datos de baja (Doctorado)";
                    $this->showBajaModal = True;
                } else {
                    $this->notify('Es necesario que el usuario tenga un registro de ingreso a doctorado', 'Sin registro de ingreso', 'error');
                }
            }
        }
    }

    public function storeGrad(){
        $this->validate();

        $graduacion = EstudianteGraduacion::updateOrcreate(
            ['ingreso_id' => $this->ingreso_id],
            [
                'estudiante_id' => $this->estudiante->id,
                'ingreso_id' => $this->ingreso_id,
                'grado_id' => $this->grado_id,

                'semestre_id' => $this->semestre_id,
                'modalidad_id' => $this->modalidad_id,
                'adscripcion_id' => $this->adscripcion_id,
                'fecha' => $this->fecha,
                'titulo' => $this->titulo,
            ]
        );

        if($graduacion->wasRecentlyCreated){
            $this->notify('El registro se creó corectamente', 'Registro creado', 'success');
        }else{
            $this->notify('El registro se modificó corectamente', 'Registro modificado', 'success');
        }

        $this->closeModal();
    }

    public function storeBaja(){
        $this->validate();

        $baja = EstudianteBaja::updateOrcreate(
            ['ingreso_id' => $this->ingreso_id],
            [
                'estudiante_id' => $this->estudiante->id,
                'ingreso_id' => $this->ingreso_id,
                'grado_id' => $this->grado_id,

                'semestre_id' => $this->semestre_id,
                'tipo_id' => $this->tipo_id,
                'motivo_id' => $this->motivo_id,
                'fecha' => $this->fecha,
            ]
        );

        if($baja->wasRecentlyCreated){
            $this->notify('El registro se creó corectamente', 'Registro creado', 'success');
        }else{
            $this->notify('El registro se modificó corectamente', 'Registro modificado', 'success');
        }

        $this->closeModal();
    }

    public function addSinodal($graduacion_id = null){
        if($graduacion_id){
            $this->graduacion_id = $graduacion_id;
            $this->card_title = "Agregar Sinodal";
            $this->showSinodalModal = True;
        }
    }

    public function storeSinodal(){
        $this->validate([
            'tutor_id'=>'required',
            'graduacion_id'=>'required',
        ]);

        $sinodal = EstudianteGraduacionTutor::updateOrCreate(
            [
                'graduacion_id' => $this->graduacion_id,
                'tutor_id' => $this->tutor_id
            ],
            [
                'graduacion_id' => $this->graduacion_id,
                'tutor_id' => $this->tutor_id
            ]
        );

        if($sinodal->wasRecentlyCreated){
            $this->notify('El registro se creó corectamente', 'Registro creado', 'success');
        }else{
            $this->notify('', 'Registro Existente', 'info');
        }

        $this->closeModal();
    }

    public function deleteConfirmationG(EstudianteGraduacion $graduacion){
        $this->deleteModal =true;
        $this->to_delete = $graduacion;
        $this->delete_graduacion = true;
    }

    public function deleteConfirmationB(EstudianteBaja $baja){
        $this->deleteModal =true;
        $this->to_delete = $baja;
    }

    public function deleteConfirmationS(EstudianteGraduacionTutor $sinodal){
        $this->deleteModal =true;
        $this->to_delete = $sinodal;
    }

    public function delete(){
        if($this->delete_graduacion){
            //Delete sinodales
            foreach($this->to_delete->sinodales as $sinodal){
                $sinodal->delete();
            }
        }

        $this->to_delete->delete();

        $this->reset([
            'to_delete',
            'delete_graduacion'
        ]);
        $this->deleteModal=false;
        $this->notify('Registro eliminado correctamente', 'Registro eliminado', 'error');
    }

    public function closeModal(){
        $this->showEditModal = false;
        $this->showBajaModal = false;
        $this->showSinodalModal = false;
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset([
            'semestre_id',
            'modalidad_id',
            'adscripcion_id',
            'fecha',
            'titulo',

            'tipo_id',
            'motivo_id',

            'grado_id',
            'ingreso_id',

            'tutor_id'
        ]);
        $this->mount();
    }
}
