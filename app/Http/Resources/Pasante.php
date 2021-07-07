<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Pasante extends JsonResource
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
            'Cedula'=>$this->cedula,
            'NombrePasante'=>$this->NombrePasante,
            'ApellidoPasante'=>$this->ApellidoPasante,
            'TelfPasante'=>$this->TelfPasante,
            'DireccionPasante'=>$this->DireccionPasante,
            'EmailPasante'=>$this->EmailPasante,
            'FechaNacimientoPasante'=>$this->FechaNacimientoPasante,
            'CarreraPasante'=>$this->CarreraPasante,
            'InstitucionCarreraPasante'=>$this->InstitucionCarreraPasante,
            'SemestreCarreraPasante'=>$this->SemestreCarreraPasante,
            'TotalSemestresCarreraPasante'=>$this->TotalSemestresCarreraPasante,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
