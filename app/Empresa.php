<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Empresa extends Model
{
    protected $fillable =[
        'RUC',
        'nomEmpresa',
        'tipoEmpresa',
        'telfEmpresa',
        'emailEmpresa',
        'direccionEmpresa',
        'claveEmpresa',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }

}
