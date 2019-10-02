<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
 
    
class Alumno extends Model
{

    protected $primaryKey = 'num_control';
    protected $fillable = [
        'num_control','curp_alumno','carrera', 'semestre', 'estatus' 

    ];

    use SoftDeletes;
    protected $table = 'alumnos';
    protected $dates = ['deleted_at'];
    //un alumno es una persona
    public function persona(){
        return $this->belongsTo(Persona::class,'curp');
    }

    public function boleta(){
        return $this->hasMany(Boleta::class,'id_boleta','num_control');
    }

    public function evaluacion(){
        return $this->belongsToMany(EvaluacionDocente::class,'num_evaluacion');
    }

    
}
