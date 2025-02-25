<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClaseEstudiante extends Model
{
    use HasFactory;
    use Notifiable;
    use LogsActivity;

    protected $table = "clases_estudiantes";

    protected $fillable = [
        'clase_id',
        'estudiante_id',
        'calificacion',
        'acreditada'
    ];

    public function estudiante(){
        return $this->belongsTo(Estudiante::class);
    }

    public function clase(){
        return $this->belongsTo(Clase::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
