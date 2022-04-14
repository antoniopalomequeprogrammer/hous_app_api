<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inmobiliaria extends Model
{
    public $timestamps = false;


    protected $guarded = ['id'];

    public function viviendas(){
        return $this->hasMany(Vivienda::class);
    }
}
