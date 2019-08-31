<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Boleta extends Model
{
    protected $primaryKey = 'id_boleta'; // UNSIGNED INTEGER
    protected $fillable = ['num_control', 'id_grupo', 'calif1', 'calif2', 'calif3', 'calif_f'];

    use SoftDeletes;
    protected $table = 'boletas';
    protected $dates = ['deleted_at'];
    //un alumno es una persona
    public function grupo(){
        return $this->belongsTo(Grupo::class,'id_grupo');
    }

    public function estudiante(){
        return $this->belongsTo(Alumno::class,'num_control');
    }
    
}
