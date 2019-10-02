<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultadoPregunta extends Model
{
    // protected $table = 'personas';
    protected $primaryKey = 'id_rp';
    protected $fillable = [
        'id_respuesta','num_evaluacion','id_pregunta'
        ];
        use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    //persona puede ser muchos alumnos
    public function pregunta(){
        return $this->hasOne(Pregunta::class,'id_pregunta','id_rp');

    }

    //persona puede ser muchos docentes
    public function respuesta(){
        return $this->hasOne(Respuesta::class,'id_respuesta','id_rp');
    }

    public function evaluacion(){
        return $this->belongsToMany(EvaluacionDocente::class,'num_evaluacion');
    }

}
