<?php

namespace App\Livewire\Tutores;

use App\Models\Tutor;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\sys\CatalogoItem;
use Illuminate\Database\Eloquent\Builder;

class TutoresTable extends Component
{
    use WithPagination;

    public $field = 'fullname', $search, $direction = 'asc', $filters = [];

    public $c_adscripciones;

    public function render()
    {
        $tutores = Tutor::query();

        $tutores->search('apellidop', $this->search)
            ->orSearch('apellidom', $this->search)
            ->orSearch('nombre', $this->search)
            ->orSearch('clave', $this->search);

        if ($this->field === 'fullname' and $this->direction) {
            $tutores->orderBy('apellidop', $this->direction)
                ->orderBy('apellidom', $this->direction)
                ->orderBy('nombre', $this->direction);
        }

        if($this->field === 'clave' and $this->direction){
            $tutores->orderBy('clave', $this->direction);
        }

        if (count($this->filters)) {
            $tutores->when(array_key_exists('adscripcion', $this->filters), function ($q) {
                $q->whereRelation('adscripcion', 'adscripcion_id', $this->filters['adscripcion']);
            });
        }

        return view('livewire.tutores.tutores-table', [
            'tutores' => $tutores->paginate(10),
        ]);
    }

    public function mount()
    {
        $this->c_adscripciones = CatalogoItem::whereRelation('catalogo', 'clave', 'ADSC')->get()->sortBy('nombre');
    }

    public function sortBy($field = null)
    {
        if ($this->field != $field) {
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

    public function clearFilters($key = null)
    {
        if ($key) {
            unset($this->filters[$key]);
        } else {
            $this->filters = [];
        }
    }
}
