<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermisoModelo extends Model
{
    protected $table = 'permiso_modelos';

    public static $rules = [
        'permiso_id' => 'required'
    ];

    protected $guarded = ['id'];
}
