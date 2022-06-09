<?php

namespace App\Http\Controllers\API;

use App\Models\Vivienda;
use App\Models\Inmobiliaria;
use Illuminate\Http\Request;
use App\Http\Resources\Vivienda as ViviendaResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\ResponseController as ResponseController;
use App\Http\Resources\ViviendaCollection;
use App\Models\Imagen;
use App\Mail\AddFavoritos;
use App\Mail\ViviendaBorradaMail;
use App\Models\User;
use App\Services\FileService;

class ViviendaController extends ResponseController
{

    public function index(Request $request)
    {
        $filtros = $request->get('filtros');
        $perPage = $request->get('perPageData');



        $viviendas = Vivienda::where(function ($query) use ($filtros, $request) {
           
            if ($filtros['search']!="") {
                
                $query->where('titulo', 'LIKE',   $filtros['search'] . '%');
            }
        })
            ->when($filtros['ascensor'], function ($query) use ($filtros) {
                
                $query->where('ascensor', $filtros['ascensor']);
            })
            ->when($filtros['terraza'] != '', function ($query) use ($filtros) {
                
                $query->where('terraza', $filtros['terraza']);
            })
            ->when($filtros['garaje'] != '', function ($query) use ($filtros) {
                $query->where('garaje', $filtros['garaje']);
            })

            ->when($filtros['precio']!= '', function ($query) use ($filtros){
                $query->where('precio', '<=', $filtros['precio']);
            })

            ->when($filtros['ciudad'] != '', function ($query) use ($filtros){
                $query->where('ciudad',$filtros['ciudad']);
            })

            ->when($filtros['habitaciones'] != 0, function ($query) use ($filtros) {

                if ($filtros['habitaciones'] >= 3) {
                    $query->where('habitacion', '>=', $filtros['habitaciones']);
                } else {
                    $query->where('habitacion', $filtros['habitaciones']);
                }
            })
            ->when($filtros['banos'] != 0, function ($query) use ($filtros) {
                if ($filtros['banos'] >= 3) {
                    $query->where('banos', '>=', $filtros['banos']);
                } else {
                    $query->where('banos', $filtros['banos']);
                }
            })->paginate($perPage);

            
            $viviendas = new ViviendaCollection($viviendas);
            return $viviendas;

        return response()->json($viviendas);
    }


    public function misFavoritas(Request $request){

        $userId = Auth::user()->id;

        $viviendasFavoritas = User::where('id',$userId)->with('viviendas')->first()->viviendas;

        return new ViviendaCollection($viviendasFavoritas);






    }

    public function addFavoritos(Request $request){
        
        $idVivienda = $request->get('idVivienda');

        $userId = Auth::user()->id;

        $existe =  \DB::table('user_vivienda')->where('user_id',$userId)->where('vivienda_id',$idVivienda)->first();

        

        if($existe){
            \DB::table('user_vivienda')->where('user_id',$userId)->where('vivienda_id',$idVivienda)->delete();
            $mensaje = 'Se ha quitado la vivienda de favoritos';
            return response()->json($mensaje);
        }else{
            
            \DB::table('user_vivienda')->insert([
                'user_id' => $userId,
                'vivienda_id' => $idVivienda,
            ]);


            // Buscar id inmobiliaria de a quien pertenece la vivienda;
            $vivienda = Vivienda::find($idVivienda);
            $auxIdInmobiliaria = Vivienda::find($idVivienda)->inmobiliaria_id;
            $correoInmobiliaria = Inmobiliaria::find($auxIdInmobiliaria)->email;

            \Mail::to($correoInmobiliaria)->send(new AddFavoritos($vivienda));

            $mensaje = 'Se ha añadido la vivienda a favoritos';
            return response()->json($mensaje);
        }





    }


    public function misViviendas(Request $request)
    {
        $perPage = $request->get('perPageData');

        

        $inmobiliaria_id = Inmobiliaria::where('user_id',\Auth::user()->id)->first()->id;
        
        $viviendas = Vivienda::where(function ($query) use ($request) {

            if ($request->has('search')) {
                $query->where('titulo', 'LIKE', '%' . $request->search . '%');
            }
        })->where('inmobiliaria_id',$inmobiliaria_id)->paginate($perPage);

        return new ViviendaCollection($viviendas);
    }

    public function vivienda($id)
    {
        $vivienda = Vivienda::where('id', $id)->with('inmobiliaria')->first();

        $vivienda = new ViviendaResource($vivienda);

        return response()->json($vivienda);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Creo los datos de la vivienda y luego las fotos.
        $userId = Auth::user()->id;
        $inmobiliaria = Inmobiliaria::where('user_id', $userId)->first();


        $garaje = $request->has('garaje')  ?  $request->get('garaje') : 0;
        $ascensor = $request->has('ascensor')  ?  $request->get('ascensor') : 0;
        $terraza = $request->has('terraza')  ?  $request->get('terraza') : 0;


        $viviendaData = [];
        $viviendaData['titulo'] = $request->get('titulo');
        $viviendaData['descripcion'] = $request->get('descripcion');
        $viviendaData['planta'] = $request->get('planta');
        $viviendaData['precio'] = $request->get('precio');
        $viviendaData['habitacion'] = $request->get('habitacion');
        $viviendaData['banos'] = $request->get('banos');
        $viviendaData['ciudad'] = $request->get('ciudad');
        $viviendaData['garaje'] = $garaje;
        $viviendaData['ascensor'] = $ascensor;
        $viviendaData['terraza'] = $terraza;
        $viviendaData['m2'] = $request->get('m2');
        $viviendaData['inmobiliaria_id'] = $inmobiliaria->id;
        $viviendaData['estado_id'] = $request->get('estado');
        $viviendaData['tipo_id'] = $request->get('tipo');

        $vivienda = Vivienda::create($viviendaData);


        if ($request->imagenes) {

            $imagenes = json_decode($request->imagenes, true);
            foreach ($imagenes as $key => $imagen) {
                $imagen = FileService::guardarArchivo($imagen, "/vivienda/{$vivienda->id}", true);


                Imagen::create([
                    'ruta' => $imagen,
                    'vivienda_id' => $vivienda->id
                ]);
            }
        }

        return $vivienda;
    }


    public function show(Vivienda $vivienda)
    {
        //
    }


    public function edit(Vivienda $vivienda)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->get('vivienda');

        $garaje = $request->has('garaje')  ?  $request->get('garaje') : 0;
        $ascensor = $request->has('ascensor')  ?  $request->get('ascensor') : 0;
        $terraza = $request->has('terraza')  ?  $request->get('terraza') : 0;
        
        Vivienda::where('id', $id)->update([
            'titulo' => $inputs['titulo'],
            'descripcion' => $inputs['descripcion'],
            'precio' => $inputs['precio'],
            'habitacion' => $inputs['habitacion'],
            'planta' => $inputs['planta'],
            'banos' => $inputs['banos'],
            'ascensor' => $ascensor,
            'garaje' => $garaje,
            'terraza' => $terraza,
            'm2' => $inputs['m2'],


        ]);

        if (isset($inputs['estado'])) {
            Vivienda::where('id', $id)->update([
                'estado_id' => $inputs['estado'],
            ]);
        }

        if (isset($inputs['tipo'])) {
            Vivienda::where('id', $id)->update([
                'tipo_id' => $inputs['tipo'],
            ]);
        }



        return response()->json("Vivienda Editada correctamente");
    }


    public function eliminarVivienda($id)
    {

        try {

            $id = Vivienda::where('id',$id)->first()->id;
            $vivienda = Vivienda::find($id);
            $imagenes = Imagen::where('vivienda_id',$id)->get();

            // ForEach que borra las imagenes almacenadas.
            foreach ($imagenes as $key => $imagen) {
                FileService::borrarArchivo($imagen->ruta);
            }

            //Borramos las rutas de las imagenes de la vivienda. 
            Imagen::where('vivienda_id',$id)->delete();


            //Listado de correos que han añadido la vivienda a favoritos

            $auxIdsUsuarios = \DB::table('user_vivienda')->where('vivienda_id',$id)->pluck('user_id')->toArray();
            $emailsUsuariosFavoritos = User::whereIn('id', $auxIdsUsuarios)->get();
            
            
            $auxArrayEmails = [];
            foreach ($emailsUsuariosFavoritos as $key => $usuario) {
                array_push($auxArrayEmails,$usuario->email);
            }

            foreach ($emailsUsuariosFavoritos as $key => $email) {
                
                \Mail::to($email)->send(new ViviendaBorradaMail($vivienda));

            }

            response()->json($emailsUsuariosFavoritos);


            // Borramos la vivienda.
            Vivienda::find($id)->delete();

        } catch (\Exeptions $e) {
            return $this->sendError("No se puede borrar la vivienda");
        }
    }
}
