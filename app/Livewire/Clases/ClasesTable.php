<?php

namespace App\Livewire\Clases;

use App\Models\Clase;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\sys\CatalogoItem;


class ClasesTable extends Component
{
    use WithPagination;

    public $field='semestre', $search, $direction='desc', $filters=[], $paginate=18;
    public $c_semestres, $c_adscripciones, $c_programas, $c_tipos;
    public $duplicarModal=false, $to_duplicate, $materia, $semestre_id, $adscripcion_id, $grupo;
    public $deleteModal=false, $to_delete;

    public function render(){
        $clases = Clase::query();
        $clases->select('*');

        //BUSCADOR
        $clases->whereHas('materia', function($q){
            $q->search('nombre', $this->search);
        })->search('titulo_alt', $this->search);

        //ORDENAMIENTO
        if($this->field === 'semestre' and $this->direction){
            $clases->join('catalogos_items as semestre', 'clases.semestre_id', '=', 'semestre.id')
            ->join('catalogos_items as adscripcion', 'clases.adscripcion_id', '=', 'adscripcion.id')
            ->join('catalogos_items as tipo', 'clases.tipo_id', '=', 'tipo.id')
            ->join('catalogos_items as materia', 'clases.materia_id', '=', 'materia.id')
            ->select(['clases.*', 'semestre.nombre', 'adscripcion.nombre', 'tipo.clave', 'materia.nombre'])
            ->orderBy('semestre.nombre', $this->direction)
            ->orderBy('adscripcion.nombre', $this->direction)
            ->orderBy('tipo.clave', 'asc')
            ->orderBy('materia.nombre', 'asc')
            ->orderBy('clases.grupo', 'asc');
            /*$clases->select(['clases.*', 'catalogos_items.nombre'])
            ->join('catalogos_items', 'clases.semestre_id', '=', 'catalogos_items.id')
            ->orderBy('catalogos_items.nombre', $this->direction);*/
        }

        if($this->field === 'adscripcion' and $this->direction){
            $clases->join('catalogos_items as adscripcion', 'clases.adscripcion_id', '=', 'adscripcion.id')
            ->join('catalogos_items as semestre', 'clases.semestre_id', '=', 'semestre.id')
            ->join('catalogos_items as tipo', 'clases.tipo_id', '=', 'tipo.id')
            ->join('catalogos_items as materia', 'clases.materia_id', '=', 'materia.id')
            ->select(['clases.*', 'semestre.nombre', 'adscripcion.nombre', 'tipo.clave', 'materia.nombre'])
            ->orderBy('adscripcion.nombre', $this->direction)
            ->orderBy('semestre.nombre', 'desc')
            ->orderBy('tipo.clave', 'asc')
            ->orderBy('materia.nombre', 'asc')
            ->orderBy('clases.grupo', 'asc');
            /*$clases->select(['clases.*', 'catalogos_items.nombre'])
            ->join('catalogos_items', 'clases.adscripcion_id', '=', 'catalogos_items.id')
            ->orderBy('catalogos_items.nombre', $this->direction);*/
        }

        if($this->field === 'materia' and $this->direction){
            $clases->join('catalogos_items as materia', 'clases.materia_id', '=', 'materia.id')
            ->join('catalogos_items as adscripcion', 'clases.adscripcion_id', '=', 'adscripcion.id')
            ->join('catalogos_items as semestre', 'clases.semestre_id', '=', 'semestre.id')
            ->join('catalogos_items as tipo', 'clases.tipo_id', '=', 'tipo.id')

            ->select(['clases.*', 'semestre.nombre', 'adscripcion.nombre', 'tipo.clave', 'materia.nombre'])

            ->orderBy('materia.nombre', $this->direction)
            ->orderBy('semestre.nombre', 'desc')
            ->orderBy('adscripcion.nombre', 'asc')
            ->orderBy('tipo.clave', 'asc')
            ->orderBy('clases.grupo', 'asc');
            /*$clases->select(['clases.*', 'catalogos_items.nombre'])
            ->join('catalogos_items', 'clases.materia_id', '=', 'catalogos_items.id')
            ->orderBy('catalogos_items.nombre', $this->direction);*/
        }

        //FILTROS
        if(count($this->filters)){
            $clases->when(array_key_exists('semestre', $this->filters), function($q){
                $q->whereRelation('semestre', 'semestre_id', $this->filters['semestre']);
            });

            $clases->when(array_key_exists('adscripcion', $this->filters), function($q){
                $q->whereRelation('adscripcion', 'adscripcion_id', $this->filters['adscripcion']);
            });

            $clases->when(array_key_exists('tipo', $this->filters), function($q){
                $q->whereRelation('tipo', 'tipo_id', $this->filters['tipo']);
            });

            $clases->when(array_key_exists('programa', $this->filters), function($q){
                $q->whereRelation('programa', 'programa_id', $this->filters['programa']);
            });
        }



        return view('livewire.clases.clases-table', [
            'clases' => $clases->paginate($this->paginate),
        ]);
    }

    public function mount(){
        $this->c_adscripciones = CatalogoItem::whereRelation('catalogo', 'clave', 'ADSC')->get()->sortBy('nombre');
        $this->c_semestres = CatalogoItem::whereRelation('catalogo', 'clave', 'SEM')->get()->sortByDesc('nombre');
        $this->c_programas = CatalogoItem::whereRelation('catalogo', 'clave', 'PROGPOS')->get()->sortBy('nombre');
        $this->c_tipos = CatalogoItem::whereRelation('catalogo', 'clave', 'TMAT')->get()->sortBy('nombre');
    }

    public function sortBy($field = null)
    {
        if($this->field != $field){
            $this->direction = '';
        }

        $this->field = $field;

        if ($this->direction === 'asc') {
            $this->direction = 'desc';
        } elseif ($this->direction === 'desc') {
            $this->direction = '';
        } else {
            $this->direction = 'asc';
        }
    }

    public function clearFilters($key=null){
        if($key){
            unset($this->filters[$key]);
        }else{
            $this->filters = [];
        }
    }

    public function duplicarClase(Clase $clase){
        $this->to_duplicate = $clase;
        $this->materia = $clase->materia;
        $this->semestre_id = $clase->semestre_id;
        $this->adscripcion_id = $clase->adscripcion_id;
        if($clase->id){
            $this->duplicarModal = true;
        }
    }

    public function duplicar(){
        $this->validate([
            'semestre_id' => 'required|exists:catalogos_items,id',
            'adscripcion_id' => 'required|exists:catalogos_items,id',
            'grupo' => 'required',
        ]);

        $clase = $this->to_duplicate;

        $duplicate = Clase::create([
            'materia_id'=> $clase->materia_id,
            'tipo_id' => $clase->tipo_id,
            'grado_id' => $clase->grado_id,
            'programa_id' => $clase->programa_id,
            'titulo_alt' => $clase->titulo_alt,
            'horas' => $clase->horas,
            'creditos' => $clase->creditos,

            'semestre_id' => $this->semestre_id,
            'adscripcion_id' => $this->adscripcion_id,
            'grupo' => $this->grupo,
        ]);

        if($duplicate->wasRecentlyCreated){
            $this->notify('El registro se ha duplicado', 'Registro creado', 'info');
            $this->duplicarModal = false;
            $this->mount();
        }


    }

    public function closeModal(){
        $this->duplicarModal = false;
        $this->reset(['semestre_id', 'adscripcion_id', 'grupo']);
    }

    public function confirmDelete(Clase $clase){
        $this->deleteModal = true;
        $this->to_delete = $clase;
    }

    public function delete(){
        $this->to_delete->delete();
        $this->notify('El registro se ha eliminado', 'Registro eliminado', 'info');
        $this->deleteModal = false;
        $this->mount();
    }

}
