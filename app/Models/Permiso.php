<?php

namespace App\Models;
use App\Models\PermisoModelo;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permisos';

    public static $rules = [
        'nombre' => 'required|string'
    ];

    protected $guarded = ['id'];

    public function modelo(){
        return $this->hasMany(PermisoModelo::class, 'permiso_id', 'id');
    }


}
