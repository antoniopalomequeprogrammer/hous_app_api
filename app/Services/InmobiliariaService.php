<?php
namespace App\Services;
use App\Services\GenerarRutaImgService;

class InmobiliariaService{

    public static function comprobarDatos($obj):array {
        $obj['logo'] = GenerarRutaImgService::generar($obj);
        return $obj;
    }


}

?>