<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstudianteSeguimientoTutor extends Model
{
    use HasFactory;
    use Notifiable;
    use LogsActivity;

    protected $table="estudiantes_seguimientos_tutores";

    protected $fillable = [
        'seguimiento_id', 'tutor_id'
    ];

    public function seguimiento(){
        return $this->belongsTo(EstudianteSeguimiento::class);
    }

    public function tutor(){
        return $this->belongsTo(Tutor::class);
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
