<?php

namespace App\Livewire\Clases;

use App\Models\Clase;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\sys\CatalogoItem;


class ClasesTable extends Component
{
    use WithPagination;

    public $field='semestre', $search, $direction='desc', $filters=[];
    public $c_semestres, $c_adscripciones, $c_programas, $c_tipos;

    public function render(){
        $clases = Clase::query();

        $clases->whereHas('materia', function($q){
            $q->search('nombre', $this->search);
        })->search('titulo_alt', $this->search);

        if($this->field === 'semestre' and $this->direction){
            $clases->select(['clases.*', 'catalogos_items.nombre'])
            ->join('catalogos_items', 'clases.semestre_id', '=', 'catalogos_items.id')
            ->orderBy('catalogos_items.nombre', $this->direction);
        }

        if($this->field === 'materia' and $this->direction){
            $clases->select(['clases.*', 'catalogos_items.nombre'])
            ->join('catalogos_items', 'clases.materia_id', '=', 'catalogos_items.id')
            ->orderBy('catalogos_items.nombre', $this->direction);
        }

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
            'clases' => $clases->paginate(10),
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
}
