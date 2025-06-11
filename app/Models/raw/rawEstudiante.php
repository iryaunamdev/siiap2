<?php

namespace App\Models\raw;

use App\Models\sys\CatalogoItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class rawEstudiante extends Model
{
    use HasFactory;

    protected $table = "estudiantes";

    protected $hidden =[
        //'id',
        'cuenta',
        //'orcid',
        //'nombre',
        //'apellidop',
        //'apellidom',
        'rfc',
        'curp',
        'sexo_id',
        'nacionalidad_id',
        'lugar_nacimiento',
        'fecha_nacimiento',
        //'email',
        'email_alt',
        'photo_url',
        'created_at',
        'updated_at',

        'sexo_item',
        'nacionalidad_item'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'datetime',
    ];

    protected $appends = [
        'fullname',
    ];

    public function getFullnameAttribute(){
        return $this->apellidop.' '.$this->apellidom.' '.$this->nombre;
    }

    public function sexo(){
        return $this->belongsTo(rawItem::class);
    }

    public function nacionalidad(){
        return $this->belongsTo(rawItem::class);
    }

    public function inscripciones(){
        return $this->hasMany(rawInscripcion::class, 'estudiante_id')->with(['grado','semestre'=>function($q){
            $q->orderBy('nombre','desc');
        }, 'adscripcion']);
    }

    public function clases(){
        return $this->hasMany(rawEstudianteClase::class, 'estudiante_id');
    }

}
