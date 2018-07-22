<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function setNombresAttribute($nombres)
    {
        $this->attributes['nombres'] = ucfirst($nombres);
    }
    public function setApellidosAttribute($apellidos)
    {
        $this->attributes['apellidos'] = ucfirst($apellidos);
    }
    public function setNicknameAttribute($nickname)
    {
        $this->attributes['nickname'] = ucfirst($nickname);
    }
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    public function setNacimientoAttribute($nacimiento)
    {
        $this->attributes['nacimiento'] = date( 'Y-m-d', strtotime( $nacimiento ) );
    }
}
