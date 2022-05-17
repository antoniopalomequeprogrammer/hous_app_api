<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vivienda extends Model
{

    protected $guarded = ['id'];

    public function estado(){
        return $this->hasOne(Estado::class);
    }

    public function imagenes(){
        return $this->hasMany(Imagen::class);
    }

    public function tipo(){
        return $this->hasOne(Tipo::class);
    }

    public function inmobiliaria(){
        return $this->belongsTo(Inmobiliaria::class);
    }

    public function notificaciones(){
        return $this->hasMany(Notificacion::class);
    }
}
