<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Capacitacion extends Model
{
    protected $fillable =[
        'nombreCapacitacion',
        'nombreInstitucionCapacitadora',
        'fechaInicioCapacitacion',
        'fechaFinCapacitacion',
    ];
    public function pasante(){
        return $this->belongsTo('App\Pasante');
    }
    /*
    public static function boot(){
        static::creating(function ($pasante) {
            $pasante->pasante_id = Auth::id();
        });

    }*/

}
