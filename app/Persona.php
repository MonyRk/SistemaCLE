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
    protected $softCascade = ['alumnos','docentes'];
    
    //persona puede ser muchos alumnos
    public function alumnos(){
        return $this->hasMany(Alumno::class,'curp_alumno');

    }

    //persona puede ser muchos docentes
    public function docentes(){
        return $this->hasMany(Docente::class,'id_docente');
    }

}
