<?php

namespace App;

use App\Inscripcion;
use App\Alumno;
use App\Grupo;
use App\Fechas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Periodo extends Model
{
    protected $primaryKey = 'id_periodo';
    public $timestamps = false;
    protected $fillable = [
        'descripcion','anio','actual'
    ];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    //un periodo pertenece a un grupo
    public function nivel(){
        return $this->belongsTo(Grupo::class,'id_grupo');
    }

    public function alumno(){
        return $this->hasOne(Alumno::class,'num_control','id_periodo');
    }

    //pago para inscripcion
    public function inscripcion(){
        return $this->belongsTo(Inscripcion::class,'num_inscripcion');
    }

    public function fechas(){
        return $this->belongsTo(Fechas::class,'id');
    }
}
