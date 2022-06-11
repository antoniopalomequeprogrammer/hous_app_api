<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\ResponseController as ResponseController;
use App\Http\Resources\EstadoCollection;
use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends ResponseController
{

    public function estados(){

        return response()
                ->json(Estado::count());
    
      }

    
    public function index(Request $request)
    {
        $perPage = $request->get('perPageData');

        $estados = Estado::where(function ($query) use ($request){
            if($request->has('search')){
                $query->where('estado','LIKE','%'.$request->search.'%');
            }
        })->paginate($perPage);

        return $estados;
    }

    public function store(Request $request)
    {
       $estado = $request->get('estado');


       return Estado::create([
           'estado' => $estado['nombre']
       ]);

    }

    public function eliminarEstado($id){

        try {
          Estado::where('id',$id)->delete();
          return "ok";

      } catch (\Exeptions $e) {
          return $this->sendError("No se puede borrar el estado");
      }

      }
}
