<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pregunta;
use App\GrupoRespuesta;

class Respuesta extends Model
{
    protected $primaryKey = 'id_respuesta';
    protected $table = 'respuestas';
    protected $fillable = [
        'respuesta','grupo_respuesta'
    ];

    public function preguntas(){
        return $this->belongsToMany(Pregunta::class,'id_pregunta');
    }

    public function grupo_respuesta(){
        return $this->hasOne(GrupoRespuesta::class,'id_grupoRespuesta','id_respuesta');
    }
}
