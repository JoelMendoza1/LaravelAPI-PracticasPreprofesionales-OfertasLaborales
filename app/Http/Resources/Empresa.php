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
            'nomEmpresa'=>$this->nomEmpresa,
            'tipoEmpresa'=>$this->tipoEmpresa,
            'telfEmpresa'=>$this->telfEmpresa,
            'emailEmpresa'=>$this->emailEmpresa,
            'direccionEmpresa'=>$this->direccionEmpresa,
            'user_id'=>$this->User::find($this->user_id),

        ];
    }
}
