<?php

namespace App\Models\raw;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rawGraduacionTutor extends Model
{
    use HasFactory;

    protected $table = "estudiantes_graduaciones_tutores";

    Protected $hidden = [
        'id',
        //'graduacion_id',
        //'tutor_id',
        'created_at',
        'updated_at',

        'tutor',
        'graduacion',
    ];

    protected $appends = [
        'nombre_tutor',
    ];

    public function getNombreTutorAttribute(){
        return isset($this->tutor) ? $this->tutor->apellidop.' '.$this->tutor->apellidom.' '.$this->tutor->nombre : '';
    }

    public function graduacion(){
        return $this->belongsTo(rawGraduacion::class);
    }

    public function tutor(){
        return $this->belongsTo(rawTutor::class);
    }
}
