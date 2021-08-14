<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    protected $fillable = [
        'EstadoPostulacion',
    ];
    public function oferta(){
        return $this->belongsTo('App\Oferta');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }

}
