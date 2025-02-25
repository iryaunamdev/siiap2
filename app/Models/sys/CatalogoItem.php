<?php

namespace App\Models\sys;

use App\Models\sys\Catalogo;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class CatalogoItem extends Model
{
    use HasFactory;
    use Notifiable;
    use LogsActivity;

    protected $table = "catalogos_items";

    protected $fillable = [
        'catalogo_id',
        'clave',
        'nombre',
        'activo',
    ];

    protected $maps = [
        'nombre' => 'desc',
      ];

    public function catalogo (){
        return $this->belongsTo(Catalogo::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
