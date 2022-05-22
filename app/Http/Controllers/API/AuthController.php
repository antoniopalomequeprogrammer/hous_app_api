<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseController as ResponseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cliente;
use App\Services\StripeService;
use App\Services\FileService;
use Illuminate\Validation\Rule;
use Validator;

class AuthController extends ResponseController{
    //login
    public function login(Request $request){
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials)){
            return $this->sendError('Usuario no válido', 401);
        }

        $user = $request->user();
        //QUITAR USERTYPE-ADMIN Y ROL ADMINESTABLECIMIENTO
        if (($user->rol == 'admin') || ($user->rol == 'cliente') || ($user->rol == 'colaborador') || ($user->rol == 'vendedor') || ($user->rol == 'usuario')) {
            $success['token'] =  $user->createToken('token', [$user->rol])->accessToken;
            $success['nombre'] =  $user->nombre;
            $success['email'] =  $user->email;
            return $this->sendResponse($success);
        }else{
            return $this->sendError('Usuario no válido');
        }
    }

    public function register(Request $request){
        $input = $request->get('nuevoUsuario');
        $input['nombre'] = $request->get('nombre');
        $input['apellidos'] = $request->get('apellidos');
        $input['email'] = $request->get('email');
        $input['pass'] = $request->get('pass');
        $input['userType'] = $request->get('userType');
        $input['logo'] = $request->logo;


        $userData = [];
        $userData['nombre'] = $input['nombre'];
        $userData['email'] = $input['email'];
        $userData['apellidos'] = $input['apellidos'];
        $userData['permiso_id'] = 1;
        $userData['activo'] = 1;
        $userData['password'] = bcrypt($input['pass']);
        $userData['rol'] = $input['userType'];
        $user = User::create($userData);

        // if (isset($input['logo'])) {
        //     $imagen = FileService::guardarArchivo($input['logo'], "/logo/usuario/{$user->id}");

        //     User::where('id',$user->id)->update([
        //         'logo' => $imagen,
        //     ]);
        // }

        
        if($user){

            // $clienteNuevo = StripeService::createCustomer($user);

            // dd($clienteNuevo);

            $success['token'] =  $user->createToken('token', [$user->rol])->accessToken;
            $success['nombre'] =  $user->nombre;
            $success['email'] =  $user->email;
            $success['id'] = $user->id;
            return $this->sendResponse($success);
        }else{
            return $this->sendError('Se ha producido un error en el registro');
        }
    }


    public function checkActivo(Request $request){
        $user = $request->user();
        if ($user) {
            return $this->sendResponse($user->activo);
        }
        return $this->sendError('Usuario no logueado');
    }

    //logout
    public function logout(Request $request){

        $isUser = $request->user()->token()->revoke();
        if($isUser){
            $success['message'] = "Successfully logged out.";
            return $this->sendResponse($success);
        }else{
            $error = "Something went wrong.";
            return $this->sendResponse($error);
        }
    }

    //getuser
    public function getUser(Request $request){
        //$id = $request->user()->id;
        $user = $request->user();
        if($user){
            return $this->sendResponse($user);
        }else{
            $error = "user not found";
            return $this->sendResponse($error);
        }
    }

    public function isAdmin(Request $request){

        $user = $request->user();
        if ($user) {
            return $this->sendResponse($user);
        }else{
            return $this->sendError('No login');
        }
    }

}
