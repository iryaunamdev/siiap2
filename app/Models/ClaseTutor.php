<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClaseTutor extends Model
{
    use HasFactory;
    use Notifiable;
    use LogsActivity;

    protected $table = "clases_tutores";

    protected $fillable = [
        'clase_id',
        'tutor_id',
        'principal'
    ];

    public function tutor(){
        return $this->belongsTo(Tutor::class);
    }

    public function clase(){
        return $this->belongsTo(Clase::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
