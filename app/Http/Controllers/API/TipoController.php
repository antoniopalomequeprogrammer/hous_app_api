<?php

namespace App\Http\Controllers\API;
use App\Models\Tipo;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseController as ResponseController;
class TipoController extends ResponseController
{
    public function index()
    {
        $tipos = Tipo::all();
        return $tipos;
        // $tipos = new TiposCollection($tipos);
        // return $tipos;
    }

    public function eliminarTipo($id){

        try {
          Tipo::where('id',$id)->delete();
          return "ok";

      } catch (\Exeptions $e) {
          return $this->sendError("No se puede borrar el estado");
      }

      }
}
