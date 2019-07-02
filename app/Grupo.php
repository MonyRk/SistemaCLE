<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Persona;
use App\Aula;
use App\Docente;
use App\Periodo;
use App\Hora;

class Grupo extends Model
{
    protected $primaryKey = 'id_grupo';
    protected $fillable = [
        'grupo','nivel','aula', 'docente', 'periodo', 'hora' 
    ];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    //un grupo tiene nivel
    public function nivel(){
        return $this->hasMany(Nivel::class,'id_nivel');
    }

    //un grupo tiene aula
    public function aula(){
        return $this->hasMany(Aula::class,'id_aula');
    }

    //varios grupos tiene un docente
    public function docente(){
        return $this->hasOne(Docente::class,'id_docente');
    }

    //varios grupos tiene un periodo
    public function periodo(){
        return $this->hasOne(Periodo::class,'id_periodo');
    }

    //hora??
}
