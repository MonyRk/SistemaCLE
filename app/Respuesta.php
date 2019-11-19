<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pregunta;
use App\ClasificacionPreguntas;

class Respuesta extends Model
{
    protected $primaryKey = 'id_respuesta';
    protected $table = 'respuestas';
    protected $fillable = [
        'respuesta','valor'
    ];

    public function preguntas(){
        return $this->belongsToMany(Pregunta::class,'id_pregunta');
    }
}
