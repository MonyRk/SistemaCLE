<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membrete extends Model
{
    protected $table = 'membretes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'descripcion'
        ];
}
