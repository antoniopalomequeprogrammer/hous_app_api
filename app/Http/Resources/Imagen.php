<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Imagen extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'ruta_imagen' => $this->ruta
        ];
    }
}
