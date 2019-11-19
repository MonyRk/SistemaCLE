<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
// use App\Respuesta;

class Pregunta extends Model
{
    protected $primaryKey = 'id_pregunta';
    protected $table = 'preguntas';
    protected $fillable = [
        'pregunta','id_clasificacion','vigencia'
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //una pregunta pertenece a varias evaluaciones
    public function preguntas(){
        return $this->belongsToMany(EvaluacionDocente::class,'num_evaluacion');
    }

    //pregunta tiene una clasificacion
    public function clasificacion(){
        return $this->hasOne(ClasificacionPreguntas::class,'id_clasificacion','id_pregunta');
    }
}
