<?php

namespace App\Models;

use App\Models\sys\CatalogoItem;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstudianteIngreso extends Model
{
    use HasFactory;
    use Notifiable;
    use LogsActivity;

    protected $table = "estudiantes_ingresos";

    protected $fillable = [
        'estudiante_id',
        'semestre_id',
        'grado_id',
        'universidad_id',
        'programa_id',
        'procedencia_id',
        'promedio',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function semestre()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function grado()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function universidad()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function programa()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function procedencia()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
