<?php

namespace App\Models\raw;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rawItem extends Model
{
    use HasFactory;

    protected $table = "catalogos_items";

    protected $hidden = [
        'id',
        'catalogo_id',
        'activo',
        'created_at',
        'updated_at',
    ];

}
