<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Grupo;
//use Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nivel extends Model
{
    protected $primaryKey = 'id_nivel';
    public $timestamps = false;
    protected $fillable = [
        'nivel', 'modulo','idioma'
    ];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function grupo(){
        return $this->belongsToMany(Grupo::class,'id_grupo');
    }
}
