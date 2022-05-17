<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class Notificacions extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'mensaje' => $this->mensaje,
            'telefono' => $this->telefono,
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion
        ];
    }
}
