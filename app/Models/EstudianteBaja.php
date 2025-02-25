<?php

namespace App\Models;

use App\Models\sys\CatalogoItem;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstudianteBaja extends Model
{
    use HasFactory;
    use Notifiable;
    use LogsActivity;

    protected $table = "estudiantes_bajas";

    protected $fillable = [
        'estudiante_id',
        'ingreso_id',
        'grado_id',
        'semestre_id',
        'tipo_id',
        'fecha',
        'motivo_id',
    ];

    protected $casts = [
        'fecha'=>'date',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function ingreso(){
        return $this->belongsTo(EstudianteIngreso::class, 'ingreso_id');
    }

    public function grado()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function semestre()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function tipo()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function motivo()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
