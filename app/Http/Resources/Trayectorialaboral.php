<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Trayectorialaboral extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'Empresa'=>$this->Empresa,
            'PuestoTrabajo'=>$this->institucion,
            'Resposabilidades'=>$this->Resposabilidades,
            'FechaInicio'=>$this->FechaInicio,
            'FechaSalida'=>$this->FechaSalida,
            'Contacto'=>$this->Contacto,
            'user_id'=>$this->User::find($this->user_id),
        ];
    }
}
