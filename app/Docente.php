<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Persona;
use Illuminate\Database\Eloquent\SoftDeletes;

class Docente extends Model
{
    protected $primaryKey = 'id_docente';
    protected $fillable = [
        'curp_docente','grado_estudios','titulo','ced_prof', 'rfc', 'tipo','certificaciones'
    ];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //un docente es una persona
    public function persona(){
        return $this->belongsTo(Persona::class,'curp');
    }

    //un docente pertenece a varios grupos
    public function grupo(){
        return $this->belongsToMany(Grupos::class,'id_grupo');
    }
}
