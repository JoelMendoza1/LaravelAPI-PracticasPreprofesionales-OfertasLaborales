<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Idioma extends Model
{
    protected $fillable =[
        'Idioma',
        'Nivel'
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
