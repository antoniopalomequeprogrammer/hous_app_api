<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vivienda extends Model
{

    protected $guarded = ['id'];

    public function estado(){
        return $this->belongsTo(Estado::class);
    }

    public function imagenes(){
        return $this->hasMany(Imagen::class);
    }

    public function tipo(){
        return $this->belongsTo(Tipo::class);
    }

    public function inmobiliaria(){
        return $this->belongsTo(Inmobiliaria::class);
    }

    public function notificaciones(){
        return $this->hasMany(Notificacion::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
