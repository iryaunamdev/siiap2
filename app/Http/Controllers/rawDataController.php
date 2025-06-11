<?php

namespace App\Http\Controllers;

use App\Models\raw\rawBaja;
use App\Models\raw\rawClase;
use App\Models\raw\rawTutor;
use App\Models\raw\rawEstudiante;
use App\Models\raw\rawGraduacion;
use App\Models\raw\rawTutorClase;
use App\Models\raw\rawComiteTutor;
use App\Models\raw\rawEstudianteClase;
use App\Models\raw\rawTutorEstudiante;

class rawDataController extends Controller
{
    protected $authorized=[
        'ygHxQWZeFCZGbc7ud5EW1OIgHH5I513tkM3JMzig6im5gRs40Xg9zoTa9DqUc7vT',
    ];

    public function estudiantesJSON($token){
        if(in_array($token, $this->authorized)){
            return json_encode(
                rawEstudiante::query()
                ->whereRelation('inscripciones.adscripcion', 'clave', 'IRyA')
                ->with(['inscripciones', 'inscripciones.comite_tutor'])->get()
            );
        }else{
            return abort('403', 'No autorizado');
        }

    }

    public function tutoresJSON($token){
        if(in_array($token, $this->authorized)){
            return json_encode(rawTutor::query()->get());
        }else{
            return abort('403', 'No autorizado');
        }
    }

    public function comitetutorJSON($token){
        if(in_array($token, $this->authorized)){
            return json_encode(rawComiteTutor::query()
                ->with(['inscripcion', 'inscripcion.semestre', 'inscripcion.grado', 'inscripcion.programa', 'inscripcion.adscripcion'])->get());
        }else{
            return abort('403', 'No autorizado');
        }
    }

    public function graduacionesJSON($token){
        if(in_array($token, $this->authorized)){
            return json_encode(rawGraduacion::query()->whereRelation('adscripcion', 'clave', 'IRyA')->with(['sinodales'])->get());
        }else{
            return abort('403', 'No autorizado');
        }
    }

    public function bajasJSON($token){
        if(in_array($token, $this->authorized)){
            return json_encode(rawBaja::query()->with(['semestre', 'grado', 'tipo', 'motivo'])->get());
        }else{
            return abort('403', 'No autorizado');
        }
    }

    public function clasesJSON($token){
        if(in_array($token, $this->authorized)){
            return json_encode(rawClase::query()->whereRelation('adscripcion', 'clave', 'IRyA')
                ->with(['estudiantes','tutores','documentos'])->get());
        }else{
            return abort('403', 'No autorizado');
        }
    }

    public function clasesTutoresJSON($token){
        if(in_array($token, $this->authorized)){
            return json_encode(rawTutorClase::query()->with(['clase'])->get());
        }else{
            return abort('403', 'No autorizado');
        }
    }

    public function clasesEstudiantesJSON($token){
        if(in_array($token, $this->authorized)){
            return json_encode(rawEstudianteClase::query()->with(['clase'])->get());
        }else{
            return abort('403', 'No autorizado');
        }
    }

    protected function authorizeToken($token){
        if(in_array($token, $this->authorized)){
            return True;
        }else{
            return False;
        }

    }

}
