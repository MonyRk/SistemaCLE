<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Docente;
use App\Alumno;
use App\Pregunta;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvaluacionDocente extends Model
{
    protected $primaryKey = 'num_evaluacion';
    protected $table = 'evaluacion';
    protected $fillable = [
        'num_control','curp_docente','fecha'
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //una evaluacion tiene varias preguntas
    public function preguntas(){
        return $this->hasMany(Pregunta::class,'id_pregunta','num_evaluacion');
    }

    public function alumno(){
        return $this->hasMany(Alumno::class,'curp_alumno','num_evaluacion');
    }

    public function docente(){
        return $this->hasMany(Docente::class,'curp_docente','num_evaluacion');
    }

    public function resp_preg(){
        return $this->hasMany(ResultadoPregunta::class,'id_rp','num_evaluacion');
    }
}
