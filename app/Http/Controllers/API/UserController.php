<?php

namespace App\Http\Controllers\API;
use App\Models\User;
use App\Http\Resources\User as User_R;
use  App\Http\Resources\UserCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\ResponseController as ResponseController;

class UserController extends ResponseController
{

  public function usuarios(){

    return response()
            ->json(User::count());

  }

  public function index(Request $request){
      $perPage = $request->get('perPageData');

      $usuarios = User::where(function ($query) use ($request){

          if($request->has('search')){
              $query->where('nombre','LIKE','%'.$request->search.'%');
          }

      })->paginate($perPage);

      return new UserCollection($usuarios);

  }

  
  public function store(Request $request){
        $inputs = $request->get('usuario');
        $inputs['password'] = bcrypt($inputs['password']);
        $inputs['permiso_id'] = $inputs['rol'] == "admin" ? 1:2;
        $nuevoUsuario = User::create($inputs);
        return response()->json($nuevoUsuario);
  }

  public function cambiarPassword(Request $request){
    $inputs = $request->get('usuario');

    if($inputs['password'] == $inputs['password_confirm']){
      $passwordCambiada = User::where('id',$inputs['id'])->update([
        'password' =>  bcrypt($inputs['password']),
      ]);
      
      
      
      return $passwordCambiada?"Contraseña Cambiada Correctamente":$this->sendError("No se pudo cambiar la contraseña");

    }


  }

  public function miPerfil(Request $request){
    
    $miPerfil = User::find(\Auth::user()->id);

    $miPerfil = new User_R($miPerfil);

    return response()->json($miPerfil);

  }


  public function update(Request $request, $id)
    {
        $inputs = $request->get('usuario');

         try {
          $usuarioEditado = User::where('id',$id)->update([
            'nombre' => $inputs['nombre'],
            'apellidos' => $inputs['apellidos'],
            'email' => $inputs['email'],
            'telefono' => $inputs['telefono'],
            'rol' => $inputs['rol'],
            
          ]);

          return response()->json("Usuario Editado correctamente");
  
         } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return $this->sendError("El telefono o correo del cliente que intenta actualizar existe en la base de datos");
            }
        }
    }



    

  public function eliminarUsuario($id){
    
    try {
      User::where('id',$id)->delete();
      return "ok";
      
  } catch (\Exeptions $e) {
      return $this->sendError("No se puede borrar el usuario");
  }

  }
  

}
