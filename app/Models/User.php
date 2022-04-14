<?php

namespace App\Models;
use App\Models\Payments;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Services\FileService;

class User extends Authenticatable
{
    use SoftDeletes;
    use HasApiTokens, Notifiable;

    public static $rules = [
        'nombre' => 'required|string|max:255',
        'email' => 'required|string|max:255'
    ];

    protected $guarded = ['id'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function onlyPermiso(){
        return $this->hasOne(Permiso::class, 'id', 'permiso_id');
    }

    public function permiso(){
        return $this->hasOne(Permiso::class, 'id', 'permiso_id')->with('modelo')->first();
    }

    public function ficheros(){
       return $this->hasMany(File::class);
    }



}
