<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ViviendaCollection extends ResourceCollection
{

    public function toArray($request)
    {
        return $this->collection;
    }
}
