<?php

namespace App\Http\Resources;

use App\Models\Vivienda as ViviendaModel;
use Illuminate\Http\Resources\Json\JsonResource;

class Vivienda extends JsonResource
{

    public function toArray($request)
    {
        return [
            'total' => count(ViviendaModel::all()),
            'inmobiliaria' => $this->inmobiliaria->nombre,
            'ciudad' => $this->ciudad,
            'tipo' => $this->tipo->tipo,
            'estado' => $this->estado->estado,
            'logo_inmobiliaria' => $this->inmobiliaria->logo,
            'telefono' => $this->inmobiliaria->telefono,
            'imagenes' => $this->imagenes,
            'id' => $this->id,
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'habitacion' => $this->habitacion,
            'planta' => $this->planta,
            'banos' => $this->banos,
            'ascensor' => $this->ascensor,
            'garaje' => $this->garaje,
            'terraza' => $this->terraza,
            'm2' => $this->m2,


        ];

        //Probando
    }
}
