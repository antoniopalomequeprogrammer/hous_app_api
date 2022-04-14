<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';

    public static $rules = [
        'mensaje' => 'required|string'
    ];

    protected $guarded = ['id'];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
