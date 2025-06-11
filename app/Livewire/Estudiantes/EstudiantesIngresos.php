<?php

namespace App\Livewire\Estudiantes;

use App\Models\Estudiante;
use App\Models\EstudianteIngreso;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\sys\CatalogoItem;
use Livewire\Attributes\Validate;

class EstudiantesIngresos extends Component
{
    public $ingreso, $ingreso_id, $estudiante, $grado, $is_update=false;

    #[Validate('required')]
    public $grado_id;
    #[Validate('required')]
    public $semestre_id;
    #[Validate('required')]
    public $programa_id;

    public $universidad_id, $procedencia_id, $promedio;
    //catálogos
    public $c_semestres, $c_programas, $c_grados, $c_universidades, $c_procedencias;
    //Modales
    public $card_title, $showIngresosModal = False, $deleteModal=False, $to_delete;

    public function render()
    {
        return view('livewire.estudiantes.estudiantes-ingresos');
    }

    public function mount()
    {
        $this->c_semestres = CatalogoItem::whereRelation ('catalogo', 'clave', 'SEM')->get()->sortByDesc('nombre');
        $this->c_grados = CatalogoItem::where('clave', 'MAE')->orWhere('clave', 'DOC')->get();
        $this->c_programas = CatalogoItem::whereRelation('catalogo', 'clave', 'PROGPOS')->get()->sortBy('nombre');
        $this->c_universidades = CatalogoItem::whereRelation('catalogo', 'clave', 'UNI')->get()->sortBy('nombre');
        $this->c_procedencias = CatalogoItem::whereRelation('catalogo', 'clave', 'PROP')->get()->sortBy('nombre');
    }

    #[On('edit-ingreso')]
    public function editIngreso($id = null){
        if(isset($this->estudiante)){
            if($id){
                $this->ingreso = EstudianteIngreso::findOrFail($id);
                $this->ingreso_id = $this->ingreso->id;
                $this->grado_id = $this->ingreso->grado_id;
                $this->semestre_id = $this->ingreso->semestre_id;
                $this->programa_id = $this->ingreso->programa_id;
                $this->universidad_id = $this->ingreso->universidad_id;
                $this->procedencia_id = $this->ingreso->procedencia_id;
                $this->promedio = $this->ingreso->promedio;
                $this->card_title = "Modificar Ingreso";
                $this->is_update = true;
            }else{
                if($this->grado){
                    $this->card_title = "Ingreso a maestría";
                    $this->grado_id = $this->c_grados->where('clave', 'MAE')->first()->id;
                    $this->c_programas = CatalogoItem::whereRelation('catalogo', 'clave', 'PROGPOS')
                                                    ->where('nombre', 'like', 'Mae%')->get()->sortBy('nombre');
                }else{
                    $this->card_title = "Ingreso a doctorado";
                    $this->grado_id = $this->c_grados->where('clave', 'DOC')->first()->id;
                    $this->c_programas = CatalogoItem::whereRelation('catalogo', 'clave', 'PROGPOS')
                                                    ->where('nombre', 'like', 'Doc%')->get()->sortBy('nombre');
                }
                $this->is_update = true;
            }

            $this->showIngresosModal = true;
        }else{
            $this->notify('Se requiere un registro de estudiante previo.', 'Sin registro de estudiante.', 'error');
        }
    }

    public function store(){
        $this->validate();

        if($this->ingreso_id){
            //update
            $this->ingreso->update([
                'semestre_id' => $this->semestre_id,
                'grado_id' => $this->grado_id,
                'programa_id' => $this->programa_id,
                'universidad_id' => $this->universidad_id,
                'procedencia_id' => $this->procedencia_id,
                'promedio' => $this->promedio,
            ]);

            $this->notify('El registro se modificó correctamente.', '', 'success');
        }else{
            //Create
            //Verificar que no se dupliquen ingresos por grado/alumno
            if(!EstudianteIngreso::where('estudiante_id', $this->estudiante->id)->where('grado_id', $this->grado_id)->exists()){
                $estudiante = EstudianteIngreso::create([
                    'estudiante_id' => $this->estudiante->id,
                    'semestre_id' => $this->semestre_id,
                    'grado_id' => $this->grado_id,
                    'programa_id' => $this->programa_id,
                    'universidad_id' => $this->universidad_id,
                    'procedencia_id' => $this->procedencia_id,
                    'promedio' => $this->promedio,
                ]);
                $this->notify('Se registró el ingreso del estudiante correctamente.', '', 'success');
            }else{
                $this->notify('Ya existe un registro de ingreso para este grado.', 'Ingreso a grado duplicado', 'error');
            }
        }
        $this->closeModal();
    }

    public function closeModal(){
        $this->showIngresosModal = false;
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset([
            'semestre_id',
            'grado_id',
            'programa_id',
            'universidad_id',
            'procedencia_id',
            'promedio',
            'showIngresosModal',
        ]);
        $this->mount();
        $this->js('window.location.reload()');
    }

    public function deleteConfirmation(EstudianteIngreso $ingreso = null){
        $this->to_delete = $ingreso;
        $this->deleteModal = true;
    }

    public function delete(){
        $this->to_delete->delete();
        $this->deleteModal = false;
        $this->notify("El registro se eliminó de manera permanente.", "Registro eliminado", "error");
        $this->mount();
    }
}
