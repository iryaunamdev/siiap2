<?php

namespace App\Models\raw;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rawEstudianteClase extends Model
{
    use HasFactory;

    protected $table = "clases_estudiantes";

    protected $hidden = [
        'id',
        'clase_id',
        //'estudiante_id',
        //'calificacion',
        //'acreditada',
        'created_at',
        'updated_at',

        //'clase',
    ];

    public $with = ['clase',];

    public function clase(){
        return $this->belongsTo(rawClase::class);
    }

}
