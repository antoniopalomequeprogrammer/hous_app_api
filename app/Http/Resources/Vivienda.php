<?php

namespace App\Http\Resources;

use App\Models\Vivienda as ViviendaModel;
use Illuminate\Http\Resources\Json\JsonResource;

class Vivienda extends JsonResource
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
            'total' => count(ViviendaModel::all()),
            'inmobiliaria' => $this->inmobiliaria->nombre,
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
