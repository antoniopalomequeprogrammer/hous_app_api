<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Log;

class ResponseController extends Controller{

    public function sendResponse($response){
        return response()->json($response, 200);
    }

    public function sendError($error, $code = 500){
    	$response = [
            'error' => $error,
        ];
        return response()->json($response, $code);
    }

    public function validateToken($request){
        $user = $request->user();
        if (is_null($user)) {
            return response()->json('Token no válido', 401);
        }
    }

    public function createLog($mensaje, $error = false){

        $dataLog = [
            'user_id' => (Auth::user() ? Auth::user()->id : null),
            'mensaje' => $mensaje,
            'error' => $error
        ];

        $log = Log::create($dataLog);

        return $this->sendResponse($log);
    }
}
