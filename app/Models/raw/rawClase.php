<?php

namespace App\Models\raw;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rawClase extends Model
{
    use HasFactory;
    protected $table = "clases";

    protected $hidden = [
        'id',
        'materia_id',
        'tipo_id',
        'grado_id',
        'semestre_id',
        'programa_id',
        'adscripcion_id',
        //'grupo',
        //'horas',
        //'creditos',
        //'titulo_alt',

        'created_at',
        'updated_at',
    ];

    public $with=[
        'materia',
        'tipo',
        'grado',
        'semestre',
        'adscripcion',
        'programa',
        //'estudiantes',
        //'tutores',
        //'documentos',
    ];

    public function materia()
    {
        return $this->belongsTo(rawItem::class)->orderBy('nombre');
    }

    public function tipo()
    {
        return $this->belongsTo(rawItem::class);
    }

    public function grado()
    {
        return $this->belongsTo(rawItem::class);
    }

    public function semestre()
    {
        return $this->belongsTo(rawItem::class, 'semestre_id');
    }

    public function programa()
    {
        return $this->belongsTo(rawItem::class);
    }

    public function adscripcion()
    {
        return $this->belongsTo(rawItem::class);
    }

    public function estudiantes()
    {
        return $this->hasMany(rawClaseEstudiante::class, 'clase_id');
    }

    public function tutores()
    {
        return $this->hasMany(rawClaseTutor::class, 'clase_id');
    }

    public function documentos()
    {
        return $this->hasMany(rawClaseDocumento::class, 'clase_id');
    }


}
