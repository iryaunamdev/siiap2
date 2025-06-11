<?php

namespace App\Livewire\Clases;

use App\Models\Clase;
use App\Models\sys\CatalogoItem;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class ClasesEdit extends Component
{
    protected $authorizedRoles = [
        'admin',
        'editor'
    ];

    public $clase, $clase_id;
    public $materia_id, $semestre_id, $grado_id;
    public $adscripcion_id, $programa_id, $tipo_id, $titulo_alt, $grupo, $horas, $creditos;

    public $c_materias, $c_tipos, $c_semestres, $c_programas, $c_adscripciones, $c_grados;

    public function render()
    {
        if (Auth::user()->hasanyrole($this->authorizedRoles)) {
            return view('livewire.clases.clases-edit');
        } else {
            return abort('403', 'Usuario no autorizado');
        }
    }

    public function mount($id=null){
        if($id){
            $this->clase = Clase::findOrFail($id);
            $this->clase_id = $this->clase->id;
            $this->materia_id = $this->clase->materia_id;
            $this->semestre_id = $this->clase->semestre_id;
            $this->grado_id = $this->clase->grado_id;
            $this->tipo_id = $this->clase->tipo_id;
            $this->adscripcion_id =  $this->clase->adscripcion_id;
            $this->programa_id =  $this->clase->programa_id;
            $this->titulo_alt =  $this->clase->titulo_alt;
            $this->grupo =  $this->clase->grupo;
            $this->horas =  $this->clase->horas;
            $this->creditos =  $this->clase->creditos;
        }

        //Catalogos
        $this->c_materias = CatalogoItem::whereRelation('catalogo', 'clave', 'MAT')
                                            ->where('activo', true)
                                            ->orderBy('nombre')->get();
        $this->c_tipos = CatalogoItem::whereRelation('catalogo', 'clave', 'TMAT')
                                            ->where('activo', true)
                                            ->orderBy('nombre')->get();
        $this->c_semestres = CatalogoItem::whereRelation('catalogo', 'clave', 'SEM')
                                            ->where('activo', true)
                                            ->orderBy('nombre')->get();
        $this->c_programas = CatalogoItem::whereRelation('catalogo', 'clave', 'PROGPOS')
                                            ->where('activo', true)
                                            ->orderBy('nombre')->get();
        $this->c_adscripciones = CatalogoItem::whereRelation('catalogo', 'clave', 'ADSC')
                                            ->where('activo', true)
                                            ->orderBy('nombre')->get();
        $this->c_grados = CatalogoItem::whereRelation('catalogo', 'clave', 'GRADOS')
                                            ->where('activo', true)
                                            ->orderBy('nombre')->get();

    }

    public function store(){
        $this->validate([
            'materia_id' => 'required',
            'tipo_id' => 'required',
            'grado_id' => 'required',
            'semestre_id' => 'required',
            'programa_id' => 'required',
            'adscripcion_id' => 'required'
        ]);

        $clase = Clase::updateOrCreate(
            ['id' => $this->clase_id],
            [
                'materia_id'=> $this->materia_id,
                'tipo_id' => $this->tipo_id,
                'grado_id' => $this->grado_id,
                'semestre_id' => $this->semestre_id,
                'programa_id' => $this->programa_id,
                'adscripcion_id' => $this->adscripcion_id,
                'titulo_alt' => $this->titulo_alt,
                'grupo' => $this->grupo,
                'horas' => $this->horas,
                'creditos' => $this->creditos,
            ]
        );

        if ($clase->wasRecentlyCreated) {
            $this->notify('El registro se creó corectamente', 'Registro creado', 'success');
        } else {
            $this->notify('', 'Registro actualizado', 'info');
        }

        $this->mount($clase->id);
    }

    public function selectTipo($value){
        $tipo = CatalogoItem::findOrFail($value)->clave;
        if(in_array($tipo, ['BA', 'OB', 'OE'])){
            $this->horas = 80;
            $this->creditos = 10;
        }elseif($tipo == 'OP'){
            $this->horas = 48;
            $this->creditos = 6;
        }
    }

}
