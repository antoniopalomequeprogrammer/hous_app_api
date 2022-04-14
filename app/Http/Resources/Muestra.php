<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Muestra extends JsonResource
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
            'unidades' => $this->uds,
            'nombre' => $this->nombre,
            'nombre_latino' => $this->nombre_comun_latino,
            'valor_analisis' => $this->valor_analisis,
            'metodo_analisis' => $this->metodo_analisis,
            'observaciones' => $this->observaciones,
            'inicio_fecha_recogida' => $this->inicio_fecha_recogida,
            'final_fecha_recogida' => $this->final_fecha_recogida,
            
        ];
    }
}
