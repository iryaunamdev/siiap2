<?php

namespace App\Models;

use App\Models\sys\CatalogoItem;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clase extends Model
{
    use HasFactory;
    use Notifiable;
    use LogsActivity;

    protected $table = "clases";

    protected $fillable = [
        'materia_id',
        'tipo_id',
        'grado_id',
        'semestre_id',
        'programa_id',
        'adscripcion_id',
        'grupo',
        'horas',
        'creditos',
        'titulo_alt'
    ];

    protected $appends = [
        'materia_nombre',
    ];

    public function materia()
    {
        return $this->belongsTo(CatalogoItem::class)->orderBy('nombre');
    }

    public function getMateriaNombreAttribute(){
        return $this->materia->nombre;
    }

    public function tipo()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function grado()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function semestre()
    {
        return $this->belongsTo(CatalogoItem::class, 'semestre_id');
    }

    public function programa()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function adscripcion()
    {
        return $this->belongsTo(CatalogoItem::class);
    }

    public function estudiantes()
    {
        return $this->hasMany(ClaseEstudiante::class, 'clase_id');
    }

    public function tutores()
    {
        return $this->hasMany(ClaseTutor::class, 'clase_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
