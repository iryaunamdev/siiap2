<?php

namespace App\Models\raw;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rawTutorClase extends Model
{
    use HasFactory;

    protected $table = "clases_tutores";

    protected $hidden = [
        'id',
        'clase_id',
        //'tutor_id',
        //'principal',
        'created_at',
        'updated_at',
    ];

    public $with = ['clase'];

    public function clase(){
        return $this->belongsTo(rawClaseForTutor::class,);
    }


}
