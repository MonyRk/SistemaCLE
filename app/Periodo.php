<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Periodo extends Model
{
    protected $primaryKey = 'id_periodo';
    public $timestamps = false;
    protected $fillable = [
        'descripcion','anio'
    ];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    //un periodo pertenece a un grupo
    public function nivel(){
        return $this->belongsTo(Grupo::class,'id_grupo');
    }
}
