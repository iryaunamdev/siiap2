<?php

namespace App\Models;

use Livewire\WithFileUploads;
use App\Models\sys\CatalogoItem;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PhpOption\None;

class Estudiante extends Model
{
    use HasFactory;
    use Notifiable;
    use WithFileUploads;
    use LogsActivity;

    protected $fillable = [
        'cuenta',
        'orcid',
        'nombre',
        'apellidop',
        'apellidom',
        'rfc',
        'curp',
        'sexo_id',
        'nacionalidad_id',
        'lugar_nacimiento',
        'fecha_nacimiento',
        'email',
        'email_alt',
        'photo_url',
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
        return $this->belongsTo(CatalogoItem::class);
    }

    public function nacionalidad(){
        return $this->belongsTo(CatalogoItem::class);
    }

    public function ingresos(){
        return $this->hasMany(EstudianteIngreso::class);
    }

    public function ingreso_m(){
        return $this->hasOne(EstudianteIngreso::class)->whereRelation('grado', 'clave', 'MAE');
    }

    public function inscripciones(){
        return $this->hasMany(EstudianteInscripcion::class, 'estudiante_id')->with('semestre', function($q){
            $q->orderBy('nombre', 'desc');
        });
    }

    public function inscrito(){
        if($this->inscripciones()){
            return $this->hasOne(EstudianteInscripcion::class, 'estudiante_id')->with('semestre', function($q){
                $q->orderBy('nombre', 'desc');
            });
        }else{
            return $this->belongsTo(EstudianteInscripcion::class);
        }
    }

    public function inscripciones_m(){
        return $this->hasMany(EstudianteInscripcion::class, 'estudiante_id')->whereRelation('grado', 'clave', 'MAE')->with('semestre', function($q){
            $q->orderBy('nombre', 'desc');
        });
    }

    public function graduaciones(){
        return $this->hasMany(EstudianteGraduacion::class);
    }

    public function bajas(){
        return $this->hasMany(EstudianteBaja::class);
    }

    public function graduacion_m(){
        return $this->hasOne(EstudianteGraduacion::class)->whereRelation('grado', 'clave', 'MAE');
    }

    public function baja_m(){
        return $this->hasOne(EstudianteBaja::class)->whereRelation('grado', 'clave', 'MAE');
    }

    public function ingreso_d(){
        return $this->hasOne(EstudianteIngreso::class)->whereRelation('grado', 'clave', 'DOC');
    }

    public function inscripciones_d(){
        return $this->hasMany(EstudianteInscripcion::class, 'estudiante_id')->whereRelation('grado', 'clave', 'DOC')->with('semestre', function($q){
            $q->orderBy('nombre', 'desc');
        });
    }

    public function graduacion_d(){
        return $this->hasOne(EstudianteGraduacion::class)->whereRelation('grado', 'clave', 'DOC');
    }

    public function baja_d(){
        return $this->hasOne(EstudianteBaja::class)->whereRelation('grado', 'clave', 'DOC');
    }

    public function seguimientos(){
        return $this->hasMany(EstudianteSeguimiento::class, 'estudiante_id')->orderBy('fecha', 'desc');
    }

    public function clases(){
        return $this->hasMany(ClaseEstudiante::class, 'estudiante_id');
    }

    public function materias_maestria(){
        return $this->clases()->whereRelation('clase', function($q){
            $q->whereHas('tipo', function($q2){
                $q2->whereIn('clave', ['BA','OB', 'OP', 'OE']);
            });
        });
    }

    public function materias_propedeutico(){
        return $this->clases()->whereRelation('clase', function($q){
            $q->whereRelation('tipo', 'clave', 'PR');
        });
    }

    public function materias_basicas(){
        return $this->clases()->whereRelation('clase', function($q){
            $q->whereRelation('tipo', 'clave', 'BA');
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
