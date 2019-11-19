<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Clasificacion;

class ClasificacionPreguntas extends Model
{
    protected $primaryKey = 'id_clasificacion';
    protected $table = 'clasificacion_preguntas';
    protected $fillable = [
        'clasificacion'
    ];

    //una pregunta tiene una clasificacion
    public function preguntas(){
        return $this->belongsToMany(Pregunta::class,'id_pregunta');
    }
}
