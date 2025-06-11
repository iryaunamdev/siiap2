<?php

namespace App\Models\raw;

use App\Models\raw\rawItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class rawTutor extends Model
{
    use HasFactory;

    protected $table = "tutores";

    protected $hidden = [
        //'id',
        'clave',
        //'orcid',
        //'nombre',
        //'apellidop',
        //'apellidom',
        'rfc',
        'curp',
        'sexo_id',
        'adscripcion_id',
        'grado_id',
        'area',
        'sni_id',
        'pride_id',
        'contrato_id',
        //'email',
        'activo',
        'created_at',
        'updated_at',
    ];

    public $with=[
        'adscripcion',
    ];

    protected $appends = [
        'fullname',
    ];

    public function getFullnameAttribute(){
        return $this->apellidop.' '.$this->apellidom.' '.$this->nombre;
    }

    public function adscripcion()
    {
        return $this->belongsTo(rawItem::class);
    }

    public function tutorias(){
        return $this->hasMany(rawTutorEstudiante::class, 'tutor_id');
    }

    public function graduaciones(){
        return $this->hasMany(rawTutorGraduaciones::class, 'tutor_id');
    }

}
