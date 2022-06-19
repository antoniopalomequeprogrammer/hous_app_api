<?php 

namespace App\Services;
use App\Services\FileService;

class GenerarRutaImgService{



public static function generar($obj):string {
    $logo = "";

    if(isset($obj['logo'])){
        $path = "/".$obj['id'];
        $logo = FileService::guardarArchivo($obj['logo'], $path,true);
    }

    return $logo;
}


}


?> 