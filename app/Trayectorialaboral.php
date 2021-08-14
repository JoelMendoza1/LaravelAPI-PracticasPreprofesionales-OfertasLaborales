<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Trayectorialaboral extends Model
{
    protected $fillable=[
        'PuestoTrabajo',
        'Responsabilidades',
        'FechaInicio',
        'FechaSalida',
        'Contacto'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    /*public static function boot(){
        static::creating(function ($user) {
            $user->user_id = Auth::id();
        });
    }*/
}
