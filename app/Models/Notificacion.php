<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    public function vivienda(){
        return $this->belongsTo(Vivienda::class);
    }

    protected $guarded = ['id'];
}
