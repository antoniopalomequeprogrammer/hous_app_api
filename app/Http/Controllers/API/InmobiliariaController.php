<?php

namespace App\Http\Controllers\API;
use App\Models\Inmobiliaria;
use Illuminate\Http\Request;
use App\Models\Vivienda;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\ResponseController as ResponseController;
use App\Services\FileService;
class InmobiliariaController extends ResponseController
{

    public function index()
    {
        $inmobiliarias = Inmobiliaria::all();

        return response()->json($inmobiliarias);
    }

    public function comprobar(){
        $inmobiliaria = Inmobiliaria::where('user_id',Auth::user()->id)->first();
        if(!$inmobiliaria){
            return false;
        }
        return response()->json($inmobiliaria);
    }

    public function actualizar(Request $request){
        $input = $request->get('inmobiliaria');
        $userId = Auth::user()->id;
        $data = [];
        $data['nombre'] = $input['nombre'];
        $data['telefono'] = $input['telefono'];
        $data['direccion'] = $input['direccion'];
        $data['descripcion'] = $input['descripcion'];
        $data['email'] = $input['email'];
        $data['user_id'] = $userId;

        $inmobiliaria = Inmobiliaria::where('user_id',$userId)->first();



        if(isset($inmobiliaria)){

            Inmobiliaria::where('user_id',Auth::user()->id)->update($data);
        }else{

            Inmobiliaria::create($data);
        }



    }

    public function eliminarInmobiliaria($id){

        try {
          Inmobiliaria::where('id',$id)->delete();
          return "ok";

      } catch (\Exeptions $e) {
          return $this->sendError("No se puede borrar la inmobiliaria");
      }

      }

      public function editar(Request $request, $id)
      {
          $inputs = $request->get('inmobiliaria');

        //    try {
            Inmobiliaria::where('id',$id)->update([
              'nombre' => $inputs['nombre'],
              'telefono' => $inputs['telefono'],
              'direccion' => $inputs['direccion'],
              'descripcion' => $inputs['descripcion'],
              'logo' => $inputs['logo'],

            ]);

            return response()->json("Inmobiliaria Editada correctamente");

        //    } catch (\Illuminate\Database\QueryException $e) {
        //       $errorCode = $e->errorInfo[1];
        //       if($errorCode == 1062){
        //           return $this->sendError("El telefono o correo de la inmobiliaria que intenta actualizar existe en la base de datos");
        //       }
        //   }
      }

    public function store(Request $request)
    {

        // $nombreInmobiliaria = $request->nombre;
        $file = $request->imagenes;
        $user_id = Auth::user()->id;

        if ($file) {
            $inmobiliaria_id = Inmobiliaria::where('user_id',$user_id)->first()->id;
            $inputs['titulo'] = $request->get('titulo');
            $inputs['descripcion'] = $request->get('descripcion');
            $inputs['precio'] = $request->get('precio');
            $inputs['planta'] = $request->get('planta');
            $inputs['banos'] = $request->get('banos');
            $inputs['ascensor'] = $request->get('ascensor');
            $inputs['terraza'] = $request->get('terraza');
            $inputs['m2'] = $request->get('m2');
            $inputs['estado'] = $request->get('estado');
            $inputs['tipo'] = $request->get('tipo');
            $inputs['habitaciones'] = $request->get('habitaciones');



            $dataVivienda = [
                'titulo' => $request->get('titulo'),
                'descripcion' => $request->get('descripcion'),
                'precio' => $request->get('precio'),
                'habitacion' => $request->get('habitaciones'),
                'planta' => $request->get('planta'),
                'banos' => $request->get('banos'),
                'ascensor' => $request->get('ascensor'),
                'garaje' => $request->get('garaje'),
                'm2' => $request->get('m2'),
                'terraza' => $request->get('terraza'),
                'inmobiliaria_id' => $inmobiliaria_id,
                'estado_id' => $request->get('estado'),
                'tipo_id' => $request->get('tipo'),
            ];

            $data = Vivienda::create($dataVivienda);
            $path = "/".$data->inmobiliaria_id.'/'.$data->id;

            // $imagen = FileService::guardarArchivo($file, $path,true);
        }

        // $data = "No se ha creado la inmobiliaria";

        // $dataInmobiliaria = [
        //     'nombre' => $request->get('nombre'),
        //     'direccion' => $request->get('direccion'),
        //     'telefono' => $request->get('telefono'),
        //     'descripcion' => $request->get('descripcion'),
        //     'logo' => "",
        //     'user_id'
        // ];
        // $data = Inmobiliaria::create($dataInmobiliaria);
        return response()->json($data);
    }


    public function show(Inmobiliaria $inmobiliaria)
    {
        //
    }

    public function edit(Inmobiliaria $inmobiliaria)
    {
        //
    }

    public function update(Request $request, Inmobiliaria $inmobiliaria)
    {
        //
    }


    public function destroy(Inmobiliaria $inmobiliaria)
    {
        //
    }
}
