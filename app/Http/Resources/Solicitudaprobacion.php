<?php

namespace App\Http\Resources;

use App\Empresa;
use App\Pasante;
use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
class Solicitudaprobacion extends JsonResource
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
            'id' => $this->id,
            'estadoSolicitud' => $this->name,
            'tipo' => $this->tipo,
            'descripcion'=>$this->descripcion,
            //'empresa_id'=> Empresa::find($this->empresa_id),
            'empresa_id'=> "/api/empresas/". $this->empresa_id,
            //'pasante_id'=> Pasante::find($this->pasante_id),
            'pasante_id'=>"/api/pasantes/".$this->pasante_id,
            'user_id'=> User::find( $this->user_id),
            //'user_id'=> "/api/usuarios/". $this->user_id,
            //'created_at' => $this->created_at,

        ];
    }
}
