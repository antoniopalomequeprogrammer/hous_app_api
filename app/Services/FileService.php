<?php
namespace App\Services;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class FileService {


    public static function guardarArchivo($file, $ruta, $base64 = false)
  {

    $path = $ruta . "/";

    $storage_path = null;

    if ($base64) {

      list($type, $file) = explode(';', $file);
      list(, $file)      = explode(',', $file);
      $file = base64_decode($file);
      $type = explode('/', $type)[1];

      $nombre_fichero = 'file_' . uniqid() . '.' . $type;
      $nombre = $nombre_fichero;

      $storage_path = $path . $nombre_fichero;

      Storage::disk('public')->put($storage_path, $file);
    } else {
      $nombre = $file->getClientOriginalName();
      $nombre_fichero = uniqid() . '_' . $nombre;

      if ($file->storeAs($path, $nombre_fichero, 'public')) {
        $storage_path = $path . $nombre_fichero;
      }
    }



    $optimizePath = Storage::disk('public')->path($storage_path);
    $optimizePath = str_replace('\\', '/', $optimizePath);
    $optimizePath = str_replace('//', '/', $optimizePath);



    switch (pathinfo($optimizePath, PATHINFO_EXTENSION)) {
      case 'jpg':
        $imagenOriginal = imagecreatefromjpeg($optimizePath);

        $rutaImagenComprimida = $optimizePath;
        $calidad = 50; // Valor entre 0 y 100. Mayor calidad, mayor peso
        imagejpeg($imagenOriginal, $rutaImagenComprimida, $calidad);

        break;
      case 'png':
        $imagenOriginal = imagecreatefrompng($optimizePath);

        $rutaImagenComprimida = $optimizePath;
        $calidad = 80;
        imagepalettetotruecolor($imagenOriginal);

        imagewebp($imagenOriginal, $rutaImagenComprimida, $calidad);

        break;
      case 'webp':
        $imagenOriginal = imagecreatefromwebp($optimizePath);
        $rutaImagenComprimida = $optimizePath;
        $calidad = 50;
        imagewebp($imagenOriginal, $rutaImagenComprimida, $calidad);
        break;
      default:
        $imagenOriginal = imagecreatefromjpeg($optimizePath);

        $rutaImagenComprimida = $optimizePath;
        $calidad = 80; // Valor entre 0 y 100. Mayor calidad, mayor peso
        imagejpeg($imagenOriginal, $rutaImagenComprimida, $calidad);

        break;
    }

    // $command = 'magick convert "' . $optimizePath . '" ' . '-sampling-factor 4:2:0 -strip -quality 65' .' "' . $optimizePath . '"';
    // exec($command);

    // return ['url' => $storage_path, 'nombre' => $nombre];


    return $storage_path;
  }


  public static function obtenerArchivo($path, $perfil = false, $base64 = true)
  {

    if ($path) {
      if ($perfil) {
        return $path;
      }
    }
    return $path;
  }

  public static function borrarArchivo($path)
  {
    if (isset($path)) {
      Storage::delete('public/' . $path);
      return true;
    } else {
      return false;
    }
  }

}
