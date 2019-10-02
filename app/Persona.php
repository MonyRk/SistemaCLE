<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
//use softCasaceTrait;

class Persona extends Model
{
    // protected $table = 'personas';
    protected $primaryKey = 'curp';
    protected $fillable = [
        'curp','nombres','ap_paterno','ap_materno','calle','numero','colonia','municipio','telefono','edad','sexo'
        ];
        use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $softCascade = ['alumnos','docentes'];//,'evaluacion','boleta','alumno_inscrito'];   ???
    
    //persona puede ser muchos alumnos
    public function alumnos(){
        return $this->hasMany(Alumno::class,'curp_alumno','num_control');

    }

    //persona puede ser muchos docentes
    public function docentes(){
        return $this->hasMany(Docente::class,'curp_docente','id_docente');
    }

    //persona puede tener un usuario
    public function users(){
        return $this->hasOne(User::class,'curp_user','id_user');
    }

    public function evaluacion(){
        return $this->belongsToMany(EvaluacionDocente::class,'num_evaluacion');
    }


}
