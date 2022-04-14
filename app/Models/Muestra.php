<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Muestra extends Model
{
    protected $guarded = ['id'];


    public function analisis(){
        return $this->hasMany(Analisi::class);
    }

    

}
