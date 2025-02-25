<?php

namespace App\Models;

use App\Models\sys\CatalogoItem;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tutor extends Model
{
    use HasFactory;
    use Notifiable;
    use LogsActivity;

    protected $table = "tutores";

    protected $fillable = [
        'clave',
        'orcid',
        'nombre',
        'apellidop',
        'apellidom',
        'rfc',
        'curp',
        'sexo_id',
        'adscripcion_id',
        'grado_id',
        'area',
        'sni_id',
        'pride_id',
        'contrato_id',
        'email',
        'activo',
    ];

    protected $appends = [
        'fullname',
    ];

    public function getFullnameAttribute(){
        return $this->apellidop.' '.$this->apellidom.' '.$this->nombre;
    }

    public function sexo()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function adscripcion()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function grado()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function sni()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function pride()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function contrato()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function comites(){
        return $this->hasMany(EstudianteTutor::class,'tutor_id');
    }

    public function comites_m(){
        return $this->comites()->whereRelation('inscripcion.grado', 'clave', 'MAE');
    }

    public function comites_d(){
        return $this->comites()->whereRelation('inscripcion.grado', 'clave', 'DOC');
    }

    public function graduados(){
        return $this->hasMany(EstudianteGraduacionTutor::class);
    }

    public function graduados_m(){
        return $this->graduados()->whereRelation('graduacion.grado', 'clave', 'MAE');
    }

    public function graduados_d(){
        return $this->graduados()->whereRelation('graduacion.grado', 'clave', 'DOC');
    }

    public function seguimientos(){
        return $this->hasMany(EstudianteSeguimientoTutor::class);
    }

    public function clases(){
        return $this->hasMany(ClaseTutor::class,'tutor_id');
    }

    public function materias_m(){
        return $this->clases()->whereRelation('clase.tipo', function($q){
                $q->whereIn('clave', ['BA','OB', 'OP', 'OE']);
        });
    }

    public function materias_p(){
        return $this->clases()->whereRelation('clase.tipo', 'clave', 'PR');
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
