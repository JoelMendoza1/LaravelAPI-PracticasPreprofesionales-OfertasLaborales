<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Oferta extends Model
{
    protected $fillable =[
        'Oferta',
        'FechaOferta',
        'DescripcionOferta',
        'HorarioJornada',
        'NumeroSolicitados',
        'DirecionOferta',
        'CarreraOferta',
    ];
    public function postulacion(){
        return $this->hasMany('App\Postulacion');
    }
    public function empresa(){
        return $this->belongsTo('App\Empresa');
    }
    public static function boot(){
        parent::boot();
        static::creating(function ($empresa) {
            $empresa->empresa_id = Auth::id();
        });
    }
}
