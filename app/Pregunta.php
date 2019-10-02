<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Respuesta;

class Pregunta extends Model
{
    protected $primaryKey = 'id_pregunta';
    protected $table = 'preguntas';
    protected $fillable = [
        'pregunta','tipo','vigencia','id_respuesta'
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //una pregunta tiene varias posibles respuestas
    public function respuestas(){
        return $this->hasMany(GrupoRespuesta::class,'id_grupoRespuestas','id_pregunta');
    }

    public function preguntas(){
        return $this->belongsToMany(EvaluacionDocente::class,'num_evaluacion');
    }
}
