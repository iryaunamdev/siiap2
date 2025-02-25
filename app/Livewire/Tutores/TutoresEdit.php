<?php

namespace App\Livewire\Tutores;

use App\Models\sys\CatalogoItem;
use App\Models\Tutor;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;

class TutoresEdit extends Component
{
    protected $authorizedRoles = [
        'admin',
        'editor'
    ];

    public $tutor, $tutor_id;
    #[Validate('required', message:'Campo requerido')]
    public $apellidop, $nombre;

    public $clave, $apellidom, $rfc, $curp, $orcid, $area, $email, $activo;
    public $sexo_id, $adscripcion_id, $grado_id, $contrato_id, $sni_id, $pride_id;

    public $c_sexos, $c_adscripciones, $c_grados, $c_sni, $c_pride, $c_contratos;

    public function render()
    {
        if (Auth::user()->hasanyrole($this->authorizedRoles)) {
            return view('livewire.tutores.tutores-edit');
        } else {
            return abort('403', 'Usuario no autorizado');
        }
    }

    public function mount($id = null){
        if($id){
            $this->tutor = Tutor::findOrFail($id);
            $this->tutor_id =  $this->tutor->id;
            $this->clave = $this->tutor->clave;
            $this->nombre = $this->tutor->nombre;
            $this->apellidop = $this->tutor->apellidop;
            $this->apellidom = $this->tutor->apellidom;
            $this->rfc = $this->tutor->rfc;
            $this->curp = $this->tutor->curp;
            $this->orcid = $this->tutor->orcid;
            $this->area = $this->tutor->area;
            $this->email = $this->tutor->email;
            $this->activo = $this->tutor->activo ? True : False;
            $this->sexo_id = $this->tutor->sexo_id;
            $this->adscripcion_id = $this->tutor->adscripcion_id;
            $this->grado_id = $this->tutor->grado_id;
            $this->contrato_id = $this->tutor->contrato_id;
            $this->sni_id = $this->tutor->sni_id;
            $this->pride_id = $this->tutor->pride_id;
        }
        //Catalogos
        $this->c_sexos = CatalogoItem::whereRelation('catalogo', 'clave', 'C_SEXOS')
            ->where('activo', true)
            ->orderBy('nombre')
            ->get();
        $this->c_adscripciones = CatalogoItem::whereRelation('catalogo', 'clave', 'ADSC')
            ->where('activo', true)
            ->orderBy('nombre')
            ->get();
        $this->c_grados= CatalogoItem::whereIn('clave', ['LIC', 'MAE', 'DOC'])->get()->sortBy('nombre');
        $this->c_contratos = CatalogoItem::whereRelation('catalogo', 'clave', 'TC')
            ->where('activo', true)
            ->orderBy('nombre')
            ->get();
        $this->c_sni = CatalogoItem::whereRelation('catalogo', 'clave', 'SNI')
            ->where('activo', true)
            ->orderBy('nombre')
            ->get();
        $this->c_pride =CatalogoItem::whereRelation('catalogo', 'clave', 'PRIDE')
            ->where('activo', true)
            ->orderBy('nombre')
            ->get();
    }

    public function store(){
        $this->validate();
        $tutor = Tutor::updateOrCreate(
            [
                'id'=>$this->tutor_id,
            ],
            [
                'clave' => $this->clave,
                'nombre' => $this->nombre,
                'apellidop' => $this->apellidop,
                'apellidom' => $this->apellidom,
                'rfc' => $this->rfc,
                'curp' => $this->curp,
                'orcid' => $this->orcid,
                'sexo_id' => $this->sexo_id,
                'adscripcion_id' => $this->adscripcion_id,
                'grado_id' => $this->grado_id,
                'area' => $this->area,
                'sni_id' => $this->sni_id,
                'pride_id' => $this->pride_id,
                'contrato_id' => $this->contrato_id,
                'email' => $this->email,
            ]
        );

        if ($tutor->wasRecentlyCreated) {
            $this->notify('El registro se creó corectamente', 'Registro creado', 'success');
        } else {
            $this->notify('', 'Registro actualizado', 'info');
        }

        $this->mount($tutor->id);
        $this->js('window.location.reload()');
    }

    public function activateT(Tutor $tutor){
        $tutor->update([
            'activo' => $this->activo
        ]);
    }
}
