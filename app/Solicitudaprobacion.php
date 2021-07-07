<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Solicitudaprobacion extends Model
{
    protected $fillable=['estadoSolicitud','descripcion','tipo','empresa_id','pasante_id','user_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function pasante(){
        return $this->belongsTo('App\Pasante');
    }
    public function empresa(){
        return $this->belongsTo('App\Empresa');
    }
    /*
    public static function boot(){
        parent::boot();
        static::updating(function ($solicitudaprobacion) {
            $solicitudaprobacion->empresa_id = Auth::id();
        });
        static::creating(function ($pasante) {
            $pasante->pasante_id = Auth::id();
        });

    }*/
}
