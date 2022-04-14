<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\TiposCollection;
use App\Models\Tipo;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseController as ResponseController;
class TiposController extends ResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = Tipo::all();
        $tipos = new TiposCollection($tipos);
        return $tipos;
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
       $tipo = $request->get('tipo');


       return Tipo::create([
           'tipo' => $tipo['nombre']
       ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tipos  $tipos
     * @return \Illuminate\Http\Response
     */
    public function show(Tipos $tipos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tipos  $tipos
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipos $tipos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tipos  $tipos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipos $tipos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tipos  $tipos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipos $tipos)
    {
        //
    }
}
