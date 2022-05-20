<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ImagenCollection extends ResourceCollection
{

    public function toArray($request)
    {
        return $this->collection;

    }
}
