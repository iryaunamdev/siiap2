<?php

namespace App\Models\sys;

use App\Models\sys\CatalogoItem;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Catalogo extends Model
{
    use HasFactory;
    use Notifiable;
    use LogsActivity;

    protected $table = 'catalogos';

    protected $fillable = [
        'clave',
        'nombre'
    ];

    public function items()
    {
        return $this->hasMany(CatalogoItem::class,'catalogo_id', 'id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
