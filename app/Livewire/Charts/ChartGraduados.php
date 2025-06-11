<?php

namespace App\Livewire\Charts;

use App\Models\EstudianteGraduacion;
use App\Models\sys\CatalogoItem;
use Livewire\Component;

class ChartGraduados extends Component
{

    public function render()
    {
        $labels_semestres = CatalogoItem::whereRelation('catalogo', 'clave', 'SEM')->where('nombre', '>', '2017-2')->orderBy('nombre')->pluck('nombre')->toArray();

        #graduados tot/semestre
        $graduados = $this->getGraduados();
        $graduados_t_s = $this->getBySems($labels_semestres, $graduados->get());

        #graduados mae/semestre
        $graduados = $this->getGraduados();
        //$graduados_m_s = $graduados->whereRelation('grado', 'clave', 'MAE')->get()->groupBy('semestre')->map(function ($group) { return $group->count();   })->toArray();
        $graduados_m_s = $this->getBySems($labels_semestres, $graduados->whereRelation('grado', 'clave', 'MAE')->get());

        #graduados doc/semestre
        $graduados = $this->getGraduados();
        $graduados_d_s = $this->getBySems($labels_semestres, $graduados->whereRelation('grado', 'clave', 'DOC')->get());

        //Graduados por adscripción (FC-UNAM, IA-CU, IA-ENS, ICF, ICN, IF, IRyA
        $graduados = $this->getGraduados();
        $labels_adscripciones = $graduados->orderBy('adsc')->pluck('adsc')->unique()->values()->toArray();

        $FC_UNAM = [];
        $graduados = $this->getGraduados();
        $FC_UNAM['T'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'FC-UNAM')->get());
        $graduados = $this->getGraduados();
        $FC_UNAM['M'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'FC-UNAM')->whereRelation('grado', 'clave', 'MAE')->get());
        $graduados = $this->getGraduados();
        $FC_UNAM['D'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'FC-UNAM')->whereRelation('grado', 'clave', 'DOC')->get());

        $IA_CU = [];
        $graduados = $this->getGraduados();
        $IA_CU['T'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'IA-CU')->get());
        $graduados = $this->getGraduados();
        $IA_CU['M'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'IA-CU')->whereRelation('grado','clave','MAE')->get());
        $graduados = $this->getGraduados();
        $IA_CU['D'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'IA-CU')->whereRelation('grado','clave','DOC')->get());

        $IA_ENS=[];
        $graduados = $this->getGraduados();
        $IA_ENS['T'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'IA-ENS')->get());
        $graduados = $this->getGraduados();
        $IA_ENS['M'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'IA-ENS')->whereRelation('grado','clave','MAE')->get());
        $graduados = $this->getGraduados();
        $IA_ENS['D'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'IA-ENS')->whereRelation('grado','clave','DOC')->get());

        $graduados = $this->getGraduados();
        $ICF['T'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'ICF')->get());
        $graduados = $this->getGraduados();
        $ICF['M'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'ICF')->whereRelation('grado','clave','MAE')->get());
        $graduados = $this->getGraduados();
        $ICF['D'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'ICF')->whereRelation('grado','clave','DOC')->get());

        $graduados = $this->getGraduados();
        $ICN['T'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'ICN')->get());
        $graduados = $this->getGraduados();
        $ICN['M'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'ICN')->whereRelation('grado','clave','MAE')->get());
        $graduados = $this->getGraduados();
        $ICN['D'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'ICN')->whereRelation('grado','clave','DOC')->get());

        $graduados = $this->getGraduados();
        $IF['T'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'IF')->get());
        $graduados = $this->getGraduados();
        $IF['M'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'IF')->whereRelation('grado','clave','MAE')->get());
        $graduados = $this->getGraduados();
        $IF['D'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'IF')->whereRelation('grado','clave','DOC')->get());

        $IRyA = [];
        $graduados = $this->getGraduados();
        $IRyA['T'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'IRyA')->get());
        $graduados = $this->getGraduados();
        $IRyA['M'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'IRyA')->whereRelation('grado', 'clave', 'MAE')->get());
        $graduados = $this->getGraduados();
        $IRyA['D'] = $this->getBySems($labels_semestres, $graduados->whereRelation('adscripcion', 'clave', 'IRyA')->whereRelation('grado', 'clave', 'DOC')->get());






        return view('livewire.charts.chart-graduados', compact('labels_semestres', 'graduados_t_s', 'graduados_m_s', 'graduados_d_s',
            'labels_adscripciones', 'FC_UNAM', 'IA_CU', 'IA_ENS', 'ICF', 'ICN', 'IF', 'IRyA'));
    }

    public function getGraduados(){
        return EstudianteGraduacion::query()
                ->join('catalogos_items as semestre', 'estudiantes_graduaciones.semestre_id', '=', 'semestre.id')
                ->join('catalogos_items as adscripcion', 'estudiantes_graduaciones.adscripcion_id', '=', 'adscripcion.id')
                ->join('catalogos_items as grado', 'estudiantes_graduaciones.grado_id', '=', 'grado.id')
                ->select(['estudiantes_graduaciones.*', 'semestre.nombre as semestre', 'adscripcion.clave as adsc', 'grado.clave as grado']);
    }

    public function getBySems($semestres, $data){
        $graduados = [];
        foreach ($semestres as $sem) {
            $graduados[$sem] = $data->where('semestre', $sem)->count();

        }
        return $graduados;
    }

}
