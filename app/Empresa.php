<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Empresa extends Model implements JWTSubject
{
    protected $fillable =[
        'RUC',
        'NomEmpresa',
        'TipoEmpresa',
        'TelfEmpresa',
        'EmailEmpresa',
        'DireccionEmpresa',
        'ClaveEmpresa'
    ];
    public function getJWTIdentifier(){
        return $this->getKey();
    }
    public function getJWTCustomClaims(){
        return [];
    }
    public function ofertas(){
        return $this->hasMany('App\Oferta');
    }
    public function solicitudAprobacion(){
        return $this->hasOne('App\Solicitudaprobacion');
    }
}
