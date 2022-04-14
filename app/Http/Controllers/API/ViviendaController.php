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



        $viviendas = Vivienda::where(function ($query) use ($filtros,$request){

            if($request->has('search')){
                $query->where('titulo','LIKE','%'.$request->search.'%');
            }
        })
        ->when($filtros['ascensor'] !='', function ($query) use ($filtros){
            $query->where('ascensor',(int)$filtros['ascensor']);
        })
        ->when($filtros['terraza'] !='', function ($query) use ($filtros) {
            $query->where('terraza', $filtros['terraza']);
        })
        ->when($filtros['garaje'] !='', function ($query) use ($filtros) {
            $query->where('garaje', $filtros['garaje']);
        })

        ->when($filtros['habitaciones'] != '', function ($query) use ($filtros) {

            if($filtros['habitaciones']>=3){
                $query->where('habitacion','<',$filtros['habitaciones']);
            }else{
                $query->where('habitacion',$filtros['habitaciones']);
            }
        })
        ->when($filtros['banos'] != '', function ($query) use ($filtros) {
            if($filtros['banos']>=3){
                $query->where('banos','<',$filtros['banos']);
            }else{
                $query->where('banos',$filtros['banos']);
            }
        })
        ->paginate($perPage);

        $viviendas = new ViviendaCollection($viviendas);

        return response()->json($viviendas);
    }

    public function misViviendas(Request $request){
        $perPage = $request->get('perPageData');

      $viviendas = Vivienda::where(function ($query) use ($request){

          if($request->has('search')){
              $query->where('titulo','LIKE','%'.$request->search.'%');
          }

      })->paginate($perPage);

      return new ViviendaCollection($viviendas);
    }

    public function vivienda($id){
        $vivienda = Vivienda::where('id',$id)->with('inmobiliaria')->first();

        $vivienda = new ViviendaResource($vivienda);

        return response()->json($vivienda);

    }

    public function create()
    {
        //
    }

    // public function store(Request $request)
    // {

    //     $etiquetas = json_decode($request->etiquetas, true);
    //     $precioFinal = $request->get('precio_unidad') - ($request->get('precio_unidad') * $request->get('descuento') / 100);
    //     $precioFinal = $precioFinal + ($precioFinal * $request->get('iva') / 100);
    //     $precioFinal = round($precioFinal, 2);


    //     $establecimiento = Establecimiento::where('user_id', '=', Auth::user()->id)->first();

    //     if (isset($establecimiento)) {

    //         $dataProducto = [
    //             'categoria_id' => $request->get('categoria_id'),
    //             'nombre' => $request->get('nombre'),
    //             'descripcion' => $request->get('descripcion'),
    //             'precio_unidad' => round($request->get('precio_unidad'), 2),
    //             'precio_final' => $precioFinal,
    //             'stock' => $request->get('stock'),
    //             'iva' => $request->get('iva'),
    //             'stock' => $request->get('stock'),
    //             'activo' => $request->get('activo'),
    //             'visibilidad' => $establecimiento->visibilidad == 1 ? "NO" : "SI",
    //             'establecimiento_id' => $establecimiento->id,

    //         ];

    //         $producto = Producto::create($dataProducto);

    //         if ($request->imagenes) {

    //             $imagenes = json_decode($request->imagenes, true);
    //             foreach ($imagenes as $key => $imagen) {
    //                 $imagen = FileService::guardarArchivo($imagen, "/producto/{$producto->id}", true);

    //                 // $imagen = ImageOptimizer::optimize($imagen);

    //                 Imagenes::create([
    //                     'url' => $imagen,
    //                     'producto_id' => $producto->id
    //                 ]);
    //             }
    //         }

    //         // Etiquetas.
    //         if (isset($etiquetas)) {
    //             foreach ($etiquetas as $key => $etiqueta) {


    //                 $etiquetaEstablecimientoProducto = EtiquetaEstablecimientoProducto::create([
    //                     'nombre_etiqueta' => $etiqueta['label'],
    //                     'etiqueta_id' => $etiqueta['id'],
    //                     'producto_id' => $producto->id,
    //                 ]);


    //                 foreach ($etiqueta['atributos'] as $key => $atributo) {
    //                     $precio = 0;
    //                     $activo = 0;

    //                     if (isset($atributo['precio'])) {
    //                         $precio = $atributo['precio'];
    //                     }

    //                     if (isset($atributo['activo'])) {
    //                         $activo = $atributo['activo'];
    //                     }

    //                     RespuestaEtiqueta::create([
    //                         'atributo_id' => $atributo['id'],
    //                         'etiqueta_establecimiento_producto_id' => $etiquetaEstablecimientoProducto->id,
    //                         'label' => $atributo['label'],
    //                         'activo' => $activo,
    //                         'precio' => $precio,
    //                         // 'etiqueta_id' => $atributo['etiqueta_id'],

    //                     ]);
    //                 }
    //             }
    //         }
    //     }

    //     // Busco si existe alguna relación.
    //     $existeCategoriaEstablecimiento = DB::table('categoria_establecimiento')
    //         ->where('categoria_id', $request->get('categoria_id'))
    //         ->where('establecimiento_id', $establecimiento->id)->get();


    //     if (count($existeCategoriaEstablecimiento) == 0) {

    //         // Asignar a ese establecimiento la categoria.
    //         \DB::table('categoria_establecimiento')->insert(
    //             ['categoria_id' =>  $request->get('categoria_id'), 'establecimiento_id' => $establecimiento->id,]
    //         );
    //     }



    //     return response()->json("ok");
    // }




    public function store(Request $request)
    {
        // Creo los datos de la vivienda y luego las fotos.
        $userId = Auth::user()->id;
        $inmobiliaria = Inmobiliaria::where('user_id',$userId)->first();

        $viviendaData = [];
        $viviendaData['titulo'] = $request->get('titulo');
        $viviendaData['descripcion'] = $request->get('descripcion');
        $viviendaData['planta'] = $request->get('planta');
        $viviendaData['precio'] = $request->get('precio');
        $viviendaData['habitacion'] = $request->get('habitaciones');
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
                $imagen = FileService::guardarArchivo($imagen, "/vivivenda/{$vivienda->id}", true);

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

    public function update(Request $request, Vivienda $vivienda)
    {
        //
    }

    public function destroy(Vivienda $vivienda)
    {
        //
    }
}
