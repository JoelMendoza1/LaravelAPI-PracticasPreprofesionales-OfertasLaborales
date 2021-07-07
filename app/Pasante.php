<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Pasante extends Model implements JWTSubject
{
    protected $fillable = [
        'Cedula',
        'NombrePasante',
        'ApellidoPasante',
        'TelfPasante',
        'DireccionPasante',
        'EmailPasante',
        'FechaNacimientoPasante',
        'ClavePasante',
        'CarreraPasante',
        'InstitucionCarreraPasante',
        'SemestreCarreraPasante',
        'TotalSemestresCarreraPasante'
    ];

    protected $hidden = [
        'ClavePasante', 'remember_token',
    ];

    public function getJWTIdentifier(){
        return $this->getKey();
    }
    public function getJWTCustomClaims(){
        return [];
    }
    public function capacitacion(){
        return $this->hasMany('App\Capacitacion');
    }
    public function trayectoriasLaboral(){
        return $this->hasMany('App\Trayectorialaboral');
    }
    public function proyecto(){
        return $this->hasMany('App\Proyecto');
    }
    public function instruccion(){
        return $this->hasMany('App\Instrucion');
    }
    public function habilidad(){
        return $this->hasMany('App\Habilidad');
    }
    public function idioma(){
        return $this->hasMany('App\Idioma');
    }
    public function solicitudAprobacion(){
        return $this->hasOne('App\Solicitudaprobacion');
    }
}
