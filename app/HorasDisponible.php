<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class HorasDisponible extends Model
{
    protected $primaryKey = 'id_hora';
    protected $fillable = [
        'hora1','hora2','hora3', 'hora4', 'hora5', 'hora6','hora7','hora8','hora9', 'hora10', 'hora11', 'hora12', 'hora13'
    ];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    //un grupo tiene nivel
    public function nivel(){
        return $this->belongsTo(Aula::class,'id_aula');
    }
}
