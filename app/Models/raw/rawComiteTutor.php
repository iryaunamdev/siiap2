<?php

namespace App\Models\raw;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rawComiteTutor extends Model
{
    use HasFactory;

    protected $table = "estudiantes_tutores";

    protected $hidden = [
        'id',
        //'inscripcion_id',
        //'estudiante_id',
        //'tutor_id',
        'created_at',
        'updated_at',

        'created_at',
        'updated_at',
    ];


    public function inscripcion()
    {
        return $this->belongsTo(rawInscripcion::class);
    }

    public function estudiante()
    {
        return $this->belongsTo(rawEstudiante::class);
    }

    public function tutor(){
        return $this->belongsTo(rawTutor::class);
    }
}
