<?php

namespace App\Http\Controllers\API;

use App\Models\Notificacion;
use App\Models\Inmobiliaria;
use App\Models\Vivienda;
use App\Http\Resources\NotificacionCollection;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\ResponseController as ResponseController;
class NotificacionController extends ResponseController
{
   
    public function index()
    {
        $userId = Auth::user()->id;

        $idInmobiliaria = Inmobiliaria::where('user_id',$userId)->first()->id;

        

        $idsViviendas = Vivienda::where('inmobiliaria_id',$idInmobiliaria)->select('id')->get();

        $viviendasNotificaciones = Notificacion::with('vivienda.imagenes')->whereIn('vivienda_id',$idsViviendas)->get();

        $notificaciones = new NotificacionCollection($viviendasNotificaciones);

        return response()->json($notificaciones);

    }

    
    public function crearNotificacion(Request $request)
    {
        // Obtener nombre de contacto, telefono, mensaje, id del usuario que manda el mensaje y vivienda_id


        
        $inputs = $request->get('mensaje');
        $data['mensaje'] = $inputs['mensaje'];
        $data['telefono'] = $inputs['telefono'];
        $data['nombre_contacto'] = $inputs['nombre_contacto'];
        $data['vivienda_id'] = $inputs['vivienda_id'];

        $userId = null;
        
        if($inputs['email']){
            $userId = User::where('email',$inputs['email'])->first()->id;
        }

        

        $nuevaNotificacion = Notificacion::create([
            'mensaje' => $inputs['mensaje'],
            'telefono' => $inputs['telefono'],
            'nombre_contacto' => $inputs['nombre_contacto'],
            'vivienda_id' => $inputs['vivienda_id'],
            'user_id' => $userId,
        ]);

        return $nuevaNotificacion;

    }

    public function misNotificaciones(){

        $userId = Auth::user()->id;

        return Notificacion::where('user_id',$userId);
        

    }

    
    public function eliminarNotificacion($id)
    {
        Notificacion::find($id)->delete();
    }
}
