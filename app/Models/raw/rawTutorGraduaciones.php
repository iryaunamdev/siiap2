<?php

namespace App\Models\raw;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rawTutorGraduaciones extends Model
{
    use HasFactory;

    protected $table = "estudiantes_graduaciones_tutores";

    Protected $hidden = [
        'id',
        'graduacion_id',
        'tutor_id',
        'created_at',
        'updated_at',
    ];

    public $with = ['graduacion',];

    public function graduacion(){
        return $this->belongsTo(rawGraduacion::class);
    }
}
