<?php

namespace App;

use App\Periodo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Fechas extends Model
{
    protected $table = 'fechas';
    protected $dates = ['fecha_inicio','fecha_fin'];
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $fillable = [
        'fecha_inicio','fecha_fin','periodo','proceso'

    ];

    public function setFechaInicioAttribute($value)
    {
        $this->attributes['fecha_inicio'] = Carbon::createFromFormat('d-m-Y',$value);
    }

    public function setFechaFinAttribute($value)
    {
        $this->attributes['fecha_fin'] = Carbon::createFromFormat('d-m-Y',$value);
    }

    public function periodo(){
        return $this->hasOne(Periodo::class,'id_periodo','id');
    }

    
}
