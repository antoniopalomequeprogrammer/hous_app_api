<?php

namespace App\Http\Controllers\API;
use App\Models\Tipo;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseController as ResponseController;
class TipoController extends ResponseController
{
    public function index(Request $request)
    {

        $perPage = $request->get('perPageData');

        $tipos = Tipo::where(function ($query) use ($request){
            if($request->has('search')){
                $query->where('tipo','LIKE','%'.$request->search.'%');
            }
        })->paginate($perPage);

        return $tipos;

    }

    public function eliminarTipo($id){

        // 
        try {
          Tipo::where('id',$id)->delete();
          return "ok";

      } catch (\Exeptions $e) {
          return $this->sendError("No se puede borrar el estado");
      }

      }
}
