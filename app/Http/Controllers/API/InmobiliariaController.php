<?php

namespace App\Http\Controllers\API;
use App\Models\Inmobiliaria;
use Illuminate\Http\Request;
use App\Models\Vivienda;
use App\Http\Resources\ViviendaCollection;
use App\Http\Resources\InmobiliariaCollection;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\ResponseController as ResponseController;
use App\Services\FileService;
class InmobiliariaController extends ResponseController
{

    public function inmobiliarias(){

        return response()
                ->json(Inmobiliaria::count());
    
      }


    public function index(Request $request)
    {   
        $search = $request->get('search');
        $perPage = $request->get('perPageData');

        $inmobiliarias = Inmobiliaria::where(function ($query) use ($search,$request){
            if($request->has('search')){
                $query->where('nombre', 'LIKE', '%'.$search.'%');
            }
        })->paginate($perPage);

        
        $inmobiliarias = new InmobiliariaCollection($inmobiliarias);

        return $inmobiliarias;

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
        $data['nombre'] = $request->get('nombre');
        $data['telefono'] = $request->get('telefono');
        $data['direccion'] = $request->get('direccion');
        $data['descripcion'] = $request->get('descripcion');
        $data['email'] = $request->get('email');
        $data['user_id'] = $userId;

        $path = "/".$request->get('id');

        if($request->has('logo')){
            $logo = FileService::guardarArchivo($request->get('logo'), $path,true);
            $data['logo'] = $logo;
        }

        $inmobiliaria = Inmobiliaria::where('user_id',$userId)->first();


        if(isset($inmobiliaria)){

            Inmobiliaria::where('user_id',Auth::user()->id)->update($data);
        }else{

            Inmobiliaria::create($data);
        }



    }


    public function viviendasInmobiliaria(Request $request){

        $idInmobiliaria = $request->get('idInmobiliaria');

        $viviendas = Vivienda::where('inmobiliaria_id',$idInmobiliaria)->get();
        
        $viviendas = new ViviendaCollection($viviendas);

        return response()->json($viviendas);


    }

    public function eliminarInmobiliaria($id){
        

        Inmobiliaria::find($id)->delete();

      }

      public function editar(Request $request, $id)
      {
          $inputs = $request->get('inmobiliaria');


          $inmobiliaria = Inmobiliaria::find($id);


          $path = "/".$request->get('id');
          if($request->has('logo')){
            $logo = FileService::guardarArchivo($request->get('logo'), $path,true);
            $data['logo'] = $logo;
        }


        $inmobiliaria->update();
        
            Inmobiliaria::where('id',$id)->update([
              'nombre' => $request->get('nombre'),
              'telefono' => $request->get('telefono'),
              'direccion' => $request->get('direccion'),
              'descripcion' => $request->get('descripcion'),
              'logo' => $data['logo'],

            ]);

            return response()->json("Inmobiliaria Editada correctamente");
      }

    public function store(Request $request)
    {
        dd($request->logo);
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



            // $dataVivienda = [
            //     'titulo' => $request->get('titulo'),
            //     'descripcion' => $request->get('descripcion'),
            //     'precio' => $request->get('precio'),
            //     'habitacion' => $request->get('habitaciones'),
            //     'planta' => $request->get('planta'),
            //     'banos' => $request->get('banos'),
            //     'ascensor' => $request->get('ascensor'),
            //     'garaje' => $request->get('garaje'),
            //     'm2' => $request->get('m2'),
            //     'terraza' => $request->get('terraza'),
            //     'inmobiliaria_id' => $inmobiliaria_id,
            //     'estado_id' => $request->get('estado'),
            //     'tipo_id' => $request->get('tipo'),
            // ];

            // $data = Vivienda::create($dataVivienda);
            // $path = "/".$data->inmobiliaria_id.'/'.$data->id;
            $path = "inmobiliaria/".$data->id;

            $imagen = FileService::guardarArchivo($file, $path,true);
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
