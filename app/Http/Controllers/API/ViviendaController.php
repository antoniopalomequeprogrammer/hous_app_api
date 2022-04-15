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
use App\Services\FileService;

class ViviendaController extends ResponseController
{

    public function index(Request $request)
    {
        $filtros = $request->get('filtros');
        $perPage = $request->get('perPageData');



        $viviendas = Vivienda::where(function ($query) use ($filtros, $request) {

            if ($request->has('search')) {
                $query->where('titulo', 'LIKE', '%' . $request->search . '%');
            }
        })
            ->when($filtros['ascensor'] != '', function ($query) use ($filtros) {
                $query->where('ascensor', (int)$filtros['ascensor']);
            })
            ->when($filtros['terraza'] != '', function ($query) use ($filtros) {
                $query->where('terraza', $filtros['terraza']);
            })
            ->when($filtros['garaje'] != '', function ($query) use ($filtros) {
                $query->where('garaje', $filtros['garaje']);
            })

            ->when($filtros['habitaciones'] != '', function ($query) use ($filtros) {

                if ($filtros['habitaciones'] >= 3) {
                    $query->where('habitacion', '<', $filtros['habitaciones']);
                } else {
                    $query->where('habitacion', $filtros['habitaciones']);
                }
            })
            ->when($filtros['banos'] != '', function ($query) use ($filtros) {
                if ($filtros['banos'] >= 3) {
                    $query->where('banos', '<', $filtros['banos']);
                } else {
                    $query->where('banos', $filtros['banos']);
                }
            })
            ->paginate($perPage);

        $viviendas = new ViviendaCollection($viviendas);

        return response()->json($viviendas);
    }

    public function misViviendas(Request $request)
    {
        $perPage = $request->get('perPageData');

        $viviendas = Vivienda::where(function ($query) use ($request) {

            if ($request->has('search')) {
                $query->where('titulo', 'LIKE', '%' . $request->search . '%');
            }
        })->paginate($perPage);

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

        $viviendaData = [];
        $viviendaData['titulo'] = $request->get('titulo');
        $viviendaData['descripcion'] = $request->get('descripcion');
        $viviendaData['planta'] = $request->get('planta');
        $viviendaData['precio'] = $request->get('precio');
        $viviendaData['habitacion'] = $request->get('habitacion');
        $viviendaData['banos'] = $request->get('banos');
        $viviendaData['garaje'] = $request->get('garaje');
        $viviendaData['ascensor'] = $request->get('ascensor');
        $viviendaData['terraza'] = $request->get('terraza');
        $viviendaData['m2'] = $request->get('m2');
        $viviendaData['inmobiliaria_id'] = $inmobiliaria->id;
        $viviendaData['estado_id'] = $request->get('estado');
        $viviendaData['tipo_id'] = $request->get('tipo');

        $vivienda = Vivienda::create($viviendaData);


        if ($request->imagenes) {

            $imagenes = json_decode($request->imagenes, true);
            foreach ($imagenes as $key => $imagen) {
                $imagen = FileService::guardarArchivo($imagen, "/vivienda/{$vivienda->id}", true);

                // $imagen = ImageOptimizer::optimize($imagen);

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

        // try {
        Vivienda::where('id', $id)->update([
            'titulo' => $inputs['titulo'],
            'descripcion' => $inputs['descripcion'],
            'precio' => $inputs['precio'],
            'habitacion' => $inputs['habitacion'],
            'planta' => $inputs['planta'],
            'banos' => $inputs['banos'],
            'ascensor' => $inputs['ascensor'] == "SI" ? 1 : 0,
            'garaje' => $inputs['garaje'] == "SI" ? 1 : 0,
            'terraza' => $inputs['terraza'] == "SI" ? 1 : 0,
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
            Vivienda::where('id', $id)->delete();
            return "ok";
        } catch (\Exeptions $e) {
            return $this->sendError("No se puede borrar la vivienda");
        }
    }
}
