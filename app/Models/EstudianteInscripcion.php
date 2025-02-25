<?php

namespace App\Models;

use App\Models\sys\CatalogoItem;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstudianteInscripcion extends Model
{
    use HasFactory;
    use Notifiable;
    use LogsActivity;

    protected $table = "estudiantes_inscripciones";

    protected $fillable = [
        'estudiante_id',
        'ingreso_id',
        'semestre_id',
        'grado_id',
        'programa_id',
        'adscripcion_id',
    ];

    public function Estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function ingreso()
    {
        return $this->belongsTo(EstudianteIngreso::class);
    }

    public function semestre()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function grado()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function programa()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function adscripcion()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function comite(){
        return $this->hasMany(EstudianteTutor::class, 'inscripcion_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
