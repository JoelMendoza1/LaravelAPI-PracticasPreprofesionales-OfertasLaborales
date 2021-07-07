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
    public function pasante(){
        return $this->belongsTo('App\Pasante');
    }
    public static function boot(){
        parent::boot();
        static::creating(function ($pasante) {
            $pasante->pasante_id = Auth::id();
        });
    }
}
