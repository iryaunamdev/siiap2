<?php

namespace App\Models;

use App\Models\sys\CatalogoItem;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClaseDocumento extends Model
{
    use HasFactory;
    use Notifiable;
    use LogsActivity;

    protected $table = "clases_documentos";

    protected $fillable = [
        'clase_id',
        'tipo_id',
        'titulo',
        'filename'
    ];

    public function clase(){
        return $this->belongsTo(Clase::class);
    }

    public function tipo(){
        return $this->belongsTo(CatalogoItem::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
