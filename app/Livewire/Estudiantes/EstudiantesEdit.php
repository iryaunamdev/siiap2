<?php

namespace App\Livewire\Estudiantes;

use Livewire\Component;
use App\Models\Estudiante;
use Livewire\Attributes\On;
use App\Models\sys\CatalogoItem;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class EstudiantesEdit extends Component
{
    protected $authorizedRoles = [
        'admin',
        'editor'
    ];

    public $estudiante, $estudiante_id;

    #[Validate('required', 'Campo obligatorio')]
    public $nombre;
    #[Validate('required', 'Campo obligatorio')]
    public $apellidop;

    public $cuenta, $orcid, $apellidom, $rfc, $curp, $sexo_id, $nacionalidad_id, $lugar_nacimiento, $fecha_nacimiento, $email, $email_alt, $photo_url;
    public $c_sexos, $c_paises, $s_paises;

    public function render()
    {
        if (Auth::user()->hasanyrole($this->authorizedRoles)) {
            return view('livewire.estudiantes.estudiantes-edit');
        } else {
            return abort('403', 'Usuario no autorizado');
        }
    }

    #[On('reload-estudiante-edit')]
    public function mount($id = null)
    {
        if ($id) {
            $this->estudiante = Estudiante::findOrFail($id);
            $this->estudiante_id = $this->estudiante->id;
            $this->cuenta = $this->estudiante->cuenta;
            $this->orcid = $this->estudiante->orcid;
            $this->nombre  = $this->estudiante->nombre;
            $this->apellidop = $this->estudiante->apellidop;
            $this->apellidom = $this->estudiante->apellidom;
            $this->rfc = $this->estudiante->rfc;
            $this->curp = $this->estudiante->curp;
            $this->sexo_id = $this->estudiante->sexo_id;
            $this->nacionalidad_id = $this->estudiante->nacionalidad_id;
            $this->lugar_nacimiento = $this->estudiante->lugar_nacimiento;
            $this->fecha_nacimiento = $this->estudiante->fecha_nacimiento ? $this->estudiante->fecha_nacimiento->format('Y-m-d') : null;
            $this->email = $this->estudiante->email;
            $this->email_alt = $this->estudiante->email_alt;
            $this->photo_url = $this->estudiante->photo_url;
        }

        $this->c_sexos = CatalogoItem::whereRelation('catalogo', 'clave', 'C_SEXOS')
            ->where('activo', true)
            ->orderBy('nombre')
            ->get();

        $this->c_paises = CatalogoItem::whereRelation('catalogo', 'clave', 'C_PAISES')
            ->where('activo', true)
            ->orderBy('nombre')
            ->get();
        /*$this->s_paises = CatalogoItem::whereRelation('catalogo', 'clave', 'C_PAISES')
            ->where('activo', true)
            ->orderBy('nombre')
            ->get()->pluck('nombre', 'id')->toArray();*/

    }

    public function storeEstudiante()
    {
        $this->validate();

        if($this->estudiante_id){
            //update
            $this->estudiante->update([
                'cuenta' => $this->cuenta,
                'orcid' => $this->orcid,
                'nombre' => $this->nombre,
                'apellidop' => $this->apellidop,
                'apellidom' => $this->apellidom,
                'rfc' => $this->rfc,
                'curp' => $this->curp,
                'sexo_id' => $this->sexo_id,
                'nacionalidad_id' => $this->nacionalidad_id,
                'lugar_nacimiento' => $this->lugar_nacimiento,
                'fecha_nacimiento' => $this->fecha_nacimiento,
                'email' => $this->email,
                'email_alt' => $this->email_alt,
                'photo_url' => $this->photo_url,
            ]);

            $this->notify('El registro se actualizó correctamente.', 'Registro actualizado', 'success');
            $this->dispatch('photo-update', $this->estudiante);
            $this->mount($this->estudiante_id);
            $this->js('window.location.reload()');
        }else{
            //Create
            //Validar no duplicidad de cuenta UNAM
            if(!Estudiante::where('cuenta', $this->cuenta)->exists()){
                $estudiante = Estudiante::create([
                    'cuenta' => $this->cuenta,
                    'orcid' => $this->orcid,
                    'nombre' => $this->nombre,
                    'apellidop' => $this->apellidop,
                    'apellidom' => $this->apellidom,
                    'rfc' => $this->rfc,
                    'curp' => $this->curp,
                    'sexo_id' => $this->sexo_id,
                    'nacionalidad_id' => $this->nacionalidad_id,
                    'lugar_nacimiento' => $this->lugar_nacimiento,
                    'fecha_nacimiento' => $this->fecha_nacimiento,
                    'email' => $this->email,
                    'email_alt' => $this->email_alt,
                    'photo_url' => $this->photo_url,
                ]);

                $this->notify('El registro se creó correctamente.', 'Registro de estudiante', 'success');
                $this->dispatch('photo-update', $estudiante);
                redirect()->to(route('estudiantes.edit', $estudiante->id));
            }else{
                $this->notify('El número de cuenta UNAM ya se encuentra asignado a otro registro.', 'Cuenta duplicada', 'error');
            }
        }
    }
}
