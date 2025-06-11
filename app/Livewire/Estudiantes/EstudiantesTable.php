<?php

namespace App\Livewire\Estudiantes;

use Livewire\Component;
use App\Models\Estudiante;
use Livewire\WithPagination;
use App\Models\sys\CatalogoItem;

class EstudiantesTable extends Component
{
    use WithPagination;

    public $field='fullname', $search, $direction='asc', $filters=[], $paginate=18;
    public $c_grados, $c_adscripciones, $c_semestres;

    public function render()
    {
        $estudiantes = Estudiante::query();

        $estudiantes->search('cuenta', $this->search)
            ->orSearch('apellidop', $this->search)
            ->orSearch('apellidom', $this->search)
            ->orSearch('nombre', $this->search);

        if($this->field === 'fullname' and $this->direction){
            $estudiantes->orderBy('apellidop', $this->direction)
                    ->orderBy('apellidom', $this->direction)
                    ->orderBy('nombre', $this->direction);
        }

        if($this->field === 'cuenta' and $this->direction){
            $estudiantes->orderBy('cuenta', $this->direction);
        }



        if(count($this->filters)){
            $estudiantes->with(['inscripciones']);


            $estudiantes->when(array_key_exists('grado', $this->filters), function($q){
                $q->when($this->filters['grado']==='NO', function($q){
                    $q->doesntHave('ingresos');
                }, function($q){
                    $q->whereRelation('ingresos.grado', 'clave', $this->filters['grado']);
                });
            });

            $estudiantes->when(array_key_exists('adscripcion', $this->filters), function($q){
                $q->whereRelation('inscripciones', 'adscripcion_id', $this->filters['adscripcion']);
            });

            if(array_key_exists('grado', $this->filters)){
                if($this->filters['grado'] === 'MAE'){
                    $estudiantes->when(array_key_exists('semestre_i', $this->filters), function($q){
                        $q->whereRelation('inscripciones_m', 'semestre_id', $this->filters['semestre_i'] );
                    });
                }elseif($this->filters['grado'] === 'DOC'){
                    $estudiantes->when(array_key_exists('semestre_i', $this->filters), function($q){
                        $q->whereRelation('inscripciones_d', 'semestre_id', $this->filters['semestre_i'] );
                    });
                }
            }else{
                $estudiantes->when(array_key_exists('semestre_i', $this->filters), function($q){
                    $q->whereRelation('inscripciones', 'semestre_id', $this->filters['semestre_i'] );
                });
            }


            $estudiantes->when(array_key_exists('estatus', $this->filters), function($q){
                $q->when($this->filters['estatus'] === 'G', function($q){
                    $q->has('graduaciones');
                })
                ->when($this->filters['estatus'] === 'B', function($q){
                    $q->has('bajas');
                })
                ->when($this->filters['estatus'] === 'A', function($q){
                    if(array_key_exists('grado', $this->filters)){
                        if($this->filters['grado'] === 'MAE'){
                            $q->whereRelation('inscripciones_m.semestre', 'nombre', currentSemestre());
                        }elseif($this->filters['grado'] === 'DOC'){
                            $q->whereRelation('inscripciones_d.semestre', 'nombre', currentSemestre());
                        }
                    }else{
                        $q->whereRelation('inscripciones.semestre', 'nombre', currentSemestre());
                    }
                });
             });
        }

        return view('livewire.estudiantes.estudiantes-table', [
            'estudiantes' => $estudiantes->paginate($this->paginate),
        ]);
    }

    public function mount(){
        $this->c_grados = CatalogoItem::whereIn('clave', ['MAE', 'DOC'])->get();
        $this->c_adscripciones = CatalogoItem::whereRelation('catalogo', 'clave', 'ADSC')->get()->sortBy('nombre');
        $this->c_semestres = CatalogoItem::whereRelation('catalogo', 'clave', 'SEM')->get()->sortByDesc('nombre');
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
