<?php

namespace App\Models;

use App\Models\sys\CatalogoItem;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstudianteSeguimiento extends Model
{
    use HasFactory;
    use Notifiable;
    use LogsActivity;

    protected $table = "estudiantes_seguimientos";
    protected $fillable = [
        'estudiante_id',
        'tipo_id',
        'fecha',
        'titulo',
        'estatus_id',
        'comentarios',
        'bibcode',
        'doi',
    ];

    protected $casts = [
        'fecha'=>'date',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function tipo()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function estatus()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function sinodales(){
        return $this->hasMany(EstudianteSeguimientoTutor::class, 'seguimiento_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

}
