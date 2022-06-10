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

    // public static function boot(){
    //     parent::boot();

    //     static::deleting(function ($inmobiliaria){
    //         $inmobiliaria->viviendas()
    //                      ->delete();
    //     });

    // }

}
