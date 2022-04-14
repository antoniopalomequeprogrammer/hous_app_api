<?php

namespace App\Http\Controllers\API;
use App\Models\Permiso;
use App\Models\PermisoModelo;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\ResponseController as ResponseController;

class PermisoController extends ResponseController{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(){
        return Auth::user()->permiso();
    }

    public function list(Request $request){

        $input = $request->all();
        $permisoUser = Auth::user()->permiso()->id;
        return Permiso::where(function ($query) use ($input, $permisoUser){
            if (isset($input['findBy']) && !is_null($input['findBy']) && $input['findBy'] != '') {
                $query->where('nombre', 'LIKE', '%'.$input['findBy'].'%');
            }
            $query->where('permiso_padre_id', $permisoUser);
        })->with('modelo')->get();

    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request){

        $input = $request->all();
        $input['permiso_padre_id'] = Auth::user()->permiso()->id;
        $permisoModelo = $input['permiso_modelos'];
        unset($input['permiso_modelos']);

        $validator = Validator::make($input, Permiso::$rules);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $permiso = Permiso::create($input);
        if ($permiso) {
            foreach ($permisoModelo as $key => $modelo) {
                if (is_array($modelo)) {
                    $dataModelo = [
                        'permiso_id' => $permiso->id,
                        'modelo' => $key,
                        'ver' => $modelo['ver'],
                        'crear' => $modelo['crear'],
                        'editar' => $modelo['editar'],
                        'eliminar' => $modelo['eliminar']
                    ];
                }else{
                    $dataModelo = [
                        'permiso_id' => $permiso->id,
                        'modelo' => $key,
                        'ver' => $modelo,
                        'crear' => 0,
                        'editar' => 0,
                        'eliminar' => 0
                    ];
                }
                PermisoModelo::create($dataModelo);
            }
        }

        return $this->sendResponse($permiso);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Permiso  $permiso
    * @return \Illuminate\Http\Response
    */
    public function show($id){
        $permiso = Permiso::find($id);
        if($permiso){
            return $this->sendResponse($permiso);
        }
        return $this->sendError('Permiso no encontrado');
    }

    public function update(Request $request, $id){
        $permiso = Permiso::find($id);
        if($permiso){
            $input = $request->all();
            $input['permiso_padre_id'] = Auth::user()->permiso()->id;
            $permisoModelo = $input['permiso_modelos'];
            unset($input['permiso_modelos']);

            $validator = Validator::make($input, Permiso::$rules);

            if($validator->fails()){
                return $this->sendError($validator->errors());
            }

            PermisoModelo::where('permiso_id', $permiso->id)->delete();
            foreach ($permisoModelo as $key => $modelo) {
                if (is_array($modelo)) {
                    $dataModelo = [
                        'permiso_id' => $permiso->id,
                        'modelo' => $key,
                        'ver' => $modelo['ver'],
                        'crear' => $modelo['crear'],
                        'editar' => $modelo['editar'],
                        'eliminar' => $modelo['eliminar']
                    ];
                }else{
                    $dataModelo = [
                        'permiso_id' => $permiso->id,
                        'modelo' => $key,
                        'ver' => $modelo,
                        'crear' => 0,
                        'editar' => 0,
                        'eliminar' => 0
                    ];
                }
                PermisoModelo::create($dataModelo);
            }
            $permiso->update($input);

            return $this->sendResponse($permiso);
        }

        return $this->sendError('Permiso no encontrado');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Permiso  $permiso
    * @return \Illuminate\Http\Response
    */
    public function destroy($id){

        $permiso = Permiso::find($id);
        if($permiso){
            PermisoModelo::where('permiso_id', $permiso->id)->delete();
            $permiso->delete();
            return $this->sendResponse('Permiso eliminado');
        }

        return $this->sendError('Permiso no encontrado');

    }
}
