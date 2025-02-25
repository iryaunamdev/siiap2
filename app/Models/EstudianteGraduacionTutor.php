<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstudianteGraduacionTutor extends Model
{
    use HasFactory;
    use Notifiable;
    use LogsActivity;

    protected $table = "estudiantes_graduaciones_tutores";

    Protected $fillable = [
        'graduacion_id',
        'tutor_id',
    ];

    public function graduacion(){
        return $this->belongsTo(EstudianteGraduacion::class);
    }

    public function tutor(){
        return $this->belongsTo(Tutor::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
