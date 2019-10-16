<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Grupo;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\SoftDeletes;

class Inscripcion extends Model
{
    
    use SoftDeletes;
    protected $table = 'alumno_inscrito';
    protected $dates = ['deleted_at','fecha'];
    protected $primaryKey = 'num_inscripcion';
    protected $fillable = [
        'id_grupo','num_control','folio_pago','monto_pago', 'fecha' 

    ];

    public function setFechaAttribute($value)
    {
        // dd($value);
        $this->attributes['fecha'] = Carbon::createFromFormat('d/m/Y',$value);
    }


    //un alumno puede inscribirse en un grupo
    public function grupo(){
        return $this->belongsTo(Grupo::class,'id_grupo');
    }
}
