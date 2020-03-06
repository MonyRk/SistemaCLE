<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cambio extends Model
{
    protected $primaryKey = 'id_cambio'; // UNSIGNED INTEGER
    protected $fillable = ['boleta','calif1_previo','calif1_nuevo','calif2_previo','calif2_nuevo','calif3_previo','calif3_nuevo','fecha_cambio','usuario'];

    // use SoftDeletes;
    protected $table = 'cambios';
    
    public function boleta(){
        return $this->belongsTo(Boleta::class,'id_boleta');
    }

    
    
}



// create TRIGGER actualiza_boletas_bu BEFORE UPDATE on boletas for EACH ROW INSERT INTO cambios
// (boleta,calif1_previo,calif1_nuevo,calif2_previo,calif2_nuevo,calif3_previo,calif3_nuevo,fecha_cambio,usuario)
// VALUES 
// (OLD.boleta,old.calif1,new.calif1,old.calif2,new.calif2,old.calif3,new.calif3,now(),new.usuario)