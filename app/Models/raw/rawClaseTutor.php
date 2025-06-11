<?php

namespace App\Models\raw;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rawClaseTutor extends Model
{
    use HasFactory;

    protected $table = "clases_tutores";

    protected $hidden = [
        'id',
        'clase_id',
        'tutor_id',
        //'principal',
        'created_at',
        'updated_at',

        'tutor',
    ];

    protected $appends = [
        'nombre_tutor',
        'adscripcion_tutor',
    ];

    public function getNombreTutorAttribute(){
        return isset($this->tutor) ? $this->tutor->apellidop.' '.$this->tutor->apellidom.' '.$this->tutor->nombre : '';
    }

    public function getAdscripcionTutorAttribute(){
        return isset($this->tutor) ? $this->tutor->adscripcion: '';
    }

    public function tutor(){
        return $this->belongsTo(rawTutor::class);
    }

}
