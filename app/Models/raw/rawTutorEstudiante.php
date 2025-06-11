<?php

namespace App\Models\raw;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rawTutorEstudiante extends Model
{
    use HasFactory;

    protected $table = "estudiantes_tutores";

    protected $hidden = [
        'id',
        'inscripcion_id',
        'estudiante_id',
        'tutor_id',
        'created_at',
        'updated_at',

        'estudiante',
        'inscripcion',

        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'nombre_estudiante',
        'semestre',
        'grado',
        'adscripcion',
    ];

    public function getNombreEstudianteAttribute(){
        return isset($this->estudiante) ? $this->estudiante->apellidop.' '.$this->estudiante->apellidom.' '.$this->estudiante->nombre : '';
    }

    public function getSemestreAttribute(){
        return $this->inscripcion ? $this->inscripcion->semestre : '';
    }

    public function getGradoAttribute(){
        return $this->inscripcion ? $this->inscripcion->grado : '';
    }

    public function getAdscripcionAttribute(){
        return $this->inscripcion ? $this->inscripcion->adscripcion : '';
    }

    public function inscripcion()
    {
        return $this->belongsTo(rawInscripcion::class);
    }

    public function estudiante()
    {
        return $this->belongsTo(rawEstudiante::class);
    }

}
