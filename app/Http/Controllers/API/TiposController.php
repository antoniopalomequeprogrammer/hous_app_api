<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\TiposCollection;
use App\Models\Tipo;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseController as ResponseController;
class TiposController extends ResponseController
{

    public function index()
    {
                $tipos = Tipo::all();
                    $tipos = new TiposCollection($tipos);
        return $tipos;
    }

    public function store(Request $request)
    {
       $tipo = $request->get('tipo');
       return Tipo::create([
           'tipo' => $tipo['nombre']
       ]);

    }

}
