<?php

namespace App\Models\raw;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rawInscripcion extends Model
{
    use HasFactory;
    protected $table = "estudiantes_inscripciones";

    protected $hidden = [
        //'id',
        'estudiante_id',
        'ingreso_id',
        'semestre_id',
        'grado_id',
        'programa_id',
        'adscripcion_id',

        'created_at',
        'updated_at',

        'estudiante',
    ];

    public function estudiante()
    {
        return $this->belongsTo(rawEstudiante::class);
    }

    public function semestre()
    {
        return $this->belongsTo(rawItem::class);
    }

    public function grado()
    {
        return $this->belongsTo(rawItem::class, 'grado_id');
    }

    public function programa()
    {
        return $this->belongsTo(rawItem::class);
    }

    public function adscripcion()
    {
        return $this->belongsTo(rawItem::class);
    }

    public function comite_tutor(){
        return $this->hasMany(rawEstudianteTutor::class, 'inscripcion_id');
    }
}
