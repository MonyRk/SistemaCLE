<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoRespuesta extends Model
{
    protected $primaryKey = 'id_grupoRespuestas';
    protected $table = 'grupo_respuesta';
    protected $fillable = [
        'grupoRespuesta'
    ];

    //una pregunta tiene varias posibles respuestas
    public function respuestas(){
        return $this->belongsTo(Respuesta::class,'id_respuesta');
    }
}
