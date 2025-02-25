<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstudianteTutor extends Model
{
    use HasFactory;
    use Notifiable;
    use LogsActivity;

    protected $table = "estudiantes_tutores";

    protected $fillable = [
        'inscripcion_id',
        'estudiante_id',
        'tutor_id',
        'principal'
    ];

    public function inscripcion()
    {
        return $this->belongsTo(EstudianteInscripcion::class);
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
