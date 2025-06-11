<?php

namespace App\Models\raw;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rawClaseDocumento extends Model
{
    use HasFactory;

    protected $table = "clases_documentos";

    protected $hidden = [
        'id',
        'clase_id',
        'tipo_id',
        'titulo',
        //'filename',

        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'url',
    ];

    public function getUrlAttribute(){
        return $this->filename ? 'https://www.irya.unam.mx:1443/siiap/storage/clases/'.$this->filename : '';
    }

    public function tipo(){
        return $this->belongsTo(rawItem::class);
    }
}
