<?php

namespace App\Http\Controllers\API;
use App\Models\Suscripcion;
use Illuminate\Http\Request;
use App\Http\Resources\SuscripcionCollection;
use App\Http\Controllers\API\ResponseController as ResponseController;

class SuscripcionController extends ResponseController
{
    public function index(Request $request){
        $perPage = $request->get('perPageData');
  
        $suscripciones = Suscripcion::where(function ($query) use ($request){
  
            if($request->has('search')){
                $query->where('titulo','LIKE','%'.$request->search.'%');
            }
  
        })->paginate($perPage);
        
        return new SuscripcionCollection($suscripciones);
  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Suscripcion  $suscripcion
     * @return \Illuminate\Http\Response
     */
    public function show(Suscripcion $suscripcion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Suscripcion  $suscripcion
     * @return \Illuminate\Http\Response
     */
    public function edit(Suscripcion $suscripcion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Suscripcion  $suscripcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suscripcion $suscripcion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Suscripcion  $suscripcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suscripcion $suscripcion)
    {
        //
    }
}
