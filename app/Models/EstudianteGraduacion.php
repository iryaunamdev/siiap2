<?php

namespace App\Models;

use App\Models\sys\CatalogoItem;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstudianteGraduacion extends Model
{
    use HasFactory;
    use Notifiable;
    use LogsActivity;

    protected $table = "estudiantes_graduaciones";

    protected $fillable = [
        'estudiante_id',
        'ingreso_id',
        'semestre_id',
        'modalidad_id',
        'grado_id',
        'adscripcion_id',
        'fecha',
        'titulo',
    ];

    protected $casts = [
        'fecha'=>'date',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function sinodales(){
        return $this->hasMany(EstudianteGraduacionTutor::class, 'graduacion_id')->with('tutor', function($q){
            $q->orderBy('apellidop');
        });
    }

    public function ingreso()
    {
        return $this->belongsTo(estudianteIngreso::class);
    }

    public function semestre()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function modalidad()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function grado()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function adscripcion()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
