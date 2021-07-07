<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Empresa extends JsonResource
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
            'RUC'=>$this->RUC,
            'NomEmpresa'=>$this->NomEmpresa,
            'TipoEmpresa'=>$this->TipoEmpresa,
            'TelfEmpresa'=>$this->TelfEmpresa,
            'EmailEmpresa'=>$this->EmailEmpresa,
            'DireccionEmpresa'=>$this->DireccionEmpresa,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
