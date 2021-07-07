<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Capacitacion extends JsonResource
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
            'nombreCapacitacion'=>$this->nombreCapacitacion,
            'nombreInstitucionCapacitadora'=>$this->nombreInstitucionCapacitadora,
            'fechaInicioCapacitacion'=>$this->fechaInicioCapacitacion,
            'fechaFinCapacitacion'=>$this->fechaFinCapacitacion,
            'pasante_id'=>$this->pasante_id,
        ];
    }
}
