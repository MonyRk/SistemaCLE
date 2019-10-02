<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    protected $primaryKey = 'id_historial';
    protected $table = 'historial';
    protected $fillable = [
        'num_control','nombres','ap_paterno','ap_materno','carrera', 'semestre', 'periodo',
        'anio','nivel','modulo','grupo','calif_final','A1M1','calif1',
        'A2M1','calif2','A2M2','calif3','B1M1','calif4','B1M2','calif5'

    ];

    
}