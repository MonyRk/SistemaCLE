<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Grupo;
//use Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\HorasDisponible;

class Aula extends Model
{
    protected $primaryKey = 'id_aula';
    public $timestamps = false;
    protected $fillable = [
        'num_aula', 'edificio', 'hrdisponible'
    ];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function grupo(){
        return $this->belongsTo(Grupo::class,'id_grupo');
    }

    //has many horas disponibles
    public function horas_disponibles(){
        return $this->hasMany(HorasDisponible::class,'id_hora');
    }
}
