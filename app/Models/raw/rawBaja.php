<?php

namespace App\Models\raw;

use App\Models\EstudianteIngreso;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rawBaja extends Model
{
    use HasFactory;

    protected $table = "estudiantes_bajas";

    protected $hidden = [
        'id',
        //'estudiante_id',
        //'ingreso_id',
        'grado_id',
        'semestre_id',
        'tipo_id',
        //'fecha',
        'motivo_id',
        'created_at',
        'updated_at',

        'estudiante',
        'ingreso',
    ];

    protected $casts = [
        'fecha'=>'date:d-m-Y',
    ];

    protected $appends = [
        'nombre_estudiante',
    ];

    public function getNombreEstudianteAttribute(){
        return isset($this->estudiante) ? $this->estudiante->apellidop.' '.$this->estudiante->apellidom.' '.$this->estudiante->nombre : '';
    }

    public function estudiante()
    {
        return $this->belongsTo(rawEstudiante::class);
    }

    public function ingreso(){
        return $this->belongsTo(EstudianteIngreso::class);
    }

    public function grado()
    {
        return $this->belongsTo(rawItem::class);
    }

    public function semestre()
    {
        return $this->belongsTo(rawItem::class);
    }

    public function tipo()
    {
        return $this->belongsTo(rawItem::class);
    }

    public function motivo()
    {
        return $this->belongsTo(rawItem::class);
    }
}
