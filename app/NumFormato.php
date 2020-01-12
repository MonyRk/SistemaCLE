<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NumFormato extends Model
{
    protected $table = 'num_formato';
    protected $primaryKey = 'id';
    protected $fillable = [
        'num'
        ];
    public $timestamps = false;
}
