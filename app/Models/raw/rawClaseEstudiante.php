<?php

namespace App\Models\raw;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rawClaseEstudiante extends Model
{
    use HasFactory;

    protected $table = "clases_estudiantes";

    protected $hidden = [
        'id',
        'clase_id',
        'estudiante_id',
        //'calificacion',
        //'acreditada',
        'created_at',
        'updated_at',

        'estudiante',
    ];

    protected $appends = [
        'nombre_estudiante',
    ];

    public function getNombreEstudianteAttribute(){
        return isset($this->estudiante) ? $this->estudiante->apellidop.' '.$this->estudiante->apellidom.' '.$this->estudiante->nombre : '';
    }

    public function estudiante(){
        return $this->belongsTo(rawEstudiante::class);
    }

}
