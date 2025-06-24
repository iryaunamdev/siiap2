<?php

namespace App\Livewire\Consultas;

use App\Models\EstudianteSeguimiento;
use Livewire\Component;

class ConsultaSeguimientos extends Component
{
    public $field = 'fecha', $search, $direction = 'asc', $filters = [], $paginate=18;
    public function render()
    {
        $seguimientos = EstudianteSeguimiento::query();

        //search
        $seguimientos->join('estudiantes as estudiante', 'estudiantes_seguimientos.estudiante_id', '=', 'estudiante.id')
            ->select(['estudiantes_seguimientos.*', 'estudiante.apellidop', 'estudiante.apellidom', 'estudiante.nombre'])
            ->search('estudiante.apellidop', $this->search)
            ->orSearch('estudiante.apellidom', $this->search)
            ->orSearch('estudiante.nombre', $this->search)
            ->orSearch('titulo', $this->search);

        //Order
        if ($this->field === 'fecha' and $this->direction) {
            $direction = 'desc';
            $seguimientos->orderBy('fecha', $this->direction);
        }

        if ($this->field === 'titulo' and $this->direction) {
            $seguimientos->orderBy('titulo', $this->direction);

        }

        if ($this->field === 'estudiante' and $this->direction) {
            $seguimientos->join('estudiantes as estudiante', 'estudiantes_seguimientos.estudiante_id', '=', 'estudiante.id')
                ->select(['estudiantes_seguimientos.*', 'estudiante.apellidop', 'estudiante.apellidom', 'estudiante.nombre'])
                ->orderBy('estudiante.apellidop', $this->direction)
                ->orderBy('estudiante.apellidom', $this->direction)
                ->orderBy('estudiante.nombre', $this->direction);
        }

        if ($this->field === 'estatus' and $this->direction) {
            $seguimientos->join('catalogos_items as estatus', 'estudiantes_seguimientos.estatus_id', '=', 'estatus.id')
                ->select(['estudiantes_seguimientos.*', 'estatus.nombre'])
                ->orderBy('estatus.nombre', $this->direction);
        }

        return view('livewire.consultas.consulta-seguimientos', [
            'seguimientos' => $seguimientos->paginate($this->paginate),
        ]);
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
}
