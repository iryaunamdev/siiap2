<?php

namespace App\Models\raw;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rawGraduacion extends Model
{
    use HasFactory;

    protected $table = "estudiantes_graduaciones";

    protected $hidden = [
        'id',
        //'estudiante_id',
        'ingreso_id',
        'semestre_id',
        'modalidad_id',
        'grado_id',
        'adscripcion_id',
        //'fecha',
        //'titulo',
        'created_at',
        'updated_at',

        'estudiante'
    ];

    protected $casts = [
        'fecha'=>'date:d-m-Y',
    ];

    protected $appends = [
        'nombre_estudiante',
    ];

    public $with = [
        'grado',
        'semestre',
        'modalidad',
        'adscripcion',
    ];

    public function getNombreEstudianteAttribute(){
        return isset($this->estudiante) ? $this->estudiante->apellidop.' '.$this->estudiante->apellidom.' '.$this->estudiante->nombre : '';
    }

    public function estudiante()
    {
        return $this->belongsTo(rawEstudiante::class);
    }

    public function semestre()
    {
        return $this->belongsTo(rawItem::class);
    }

    public function modalidad()
    {
        return $this->belongsTo(rawItem::class);
    }

    public function grado()
    {
        return $this->belongsTo(rawItem::class);
    }

    public function adscripcion()
    {
        return $this->belongsTo(rawItem::class);
    }

    public function sinodales(){
        return $this->hasMany(rawGraduacionTutor::class, 'graduacion_id')->with(['tutor'=>function($q){
            $q->orderBy('apellidop')->orderBy('apellidom')->orderBy('nombre');
        }]);
    }

}
