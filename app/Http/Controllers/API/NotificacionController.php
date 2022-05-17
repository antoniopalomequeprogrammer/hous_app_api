<?php

namespace App\Http\Controllers\API;

use App\Models\Notificacion;
use App\Models\Inmobiliaria;
use App\Models\Vivienda;
use App\Http\Resources\NotificacionCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\ResponseController as ResponseController;
class NotificacionController extends ResponseController
{
   
    public function index()
    {
        $userId = Auth::user()->id;

        $idInmobiliaria = Inmobiliaria::where('user_id',$userId)->first()->id;

        

        $idsViviendas = Vivienda::where('inmobiliaria_id',$idInmobiliaria)->select('id')->get();

        $viviendasNotificaciones = Notificacion::with('vivienda')->whereIn('vivienda_id',$idsViviendas)->get();

        $notificaciones = new NotificacionCollection($viviendasNotificaciones);

        return response()->json($notificaciones);

    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(Notificacion $notificacion)
    {
        //
    }

    
    public function edit(Notificacion $notificacion)
    {
        //
    }

    
    public function update(Request $request, Notificacion $notificacion)
    {
        //
    }

    
    public function destroy(Notificacion $notificacion)
    {
        //
    }
}
