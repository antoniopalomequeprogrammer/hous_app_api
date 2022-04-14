<?php

namespace App\Imports;
use Carbon\Carbon;
use App\Models\Muestra;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;
use App\Models\Grupo;
use App\Models\Tipo;
use Maatwebsite\Excel\Concerns\HasReferencesToOtherSheets;

class MuestrasImport implements ToArray,WithHeadingRow,HasReferencesToOtherSheets
{
    private $users;

    public function __construct(){
        $this->user = Auth::user()->id;
    }


    public function array($rows)
    {   

        foreach ($rows as $key => $row) {

            return new Muestra([
                                'valor_analisis' => $row['valor_analisis'],
                                'metodo_analisis' => $row['metodo_analisis'],
                                'uds' => $row['unidades'],
                                'observaciones' => $row['observaciones'],
                                'nombre_comun_latino' => $row['nombre_latino'],
                                'grupo_id' => MuestrasImport::grupoId($row['grupo']),
                                'tipo_id' => MuestrasImport::tipoId($row['tipo']),
                                'nombre' => $row['nombre'],
                                'inicio_fecha_recogida' => Carbon::parse($row['inicio_fecha_recogida'])->format('Y-m-d'),
                                'final_fecha_recogida' => Carbon::parse($row['final_fecha_recogida'])->format('Y-m-d'),
                                'user_id' => $this->user,
                               
                            ]);
        }
        
    }



    // public function collection(Collection $row){
    //     foreach ($variable as $key => $value) {
    //         # code...
    //     }
    //     return new Muestra([
    //                 'valor_analisis' => $row['valor_analisis'],
    //                 'metodo_analisis' => $row['metodo_analisis'],
    //                 'uds' => $row['unidades'],
    //                 'observaciones' => $row['observaciones'],
    //                 'nombre_comun_latino' => $row['nombre_latino'],
    //                 'grupo_id' => MuestrasImport::grupoId($row['grupo']),
    //                 'tipo_id' => MuestrasImport::tipoId($row['tipo']),
    //                 'nombre' => $row['nombre'],
    //                 'inicio_fecha_recogida' => Carbon::parse($row['inicio_fecha_recogida'])->format('Y-m-d'),
    //                 'final_fecha_recogida' => Carbon::parse($row['final_fecha_recogida'])->format('Y-m-d'),
    //                 'user_id' => $this->user,
                   
    //             ]);
    // }



    // public function model(array $row)
    // {   
          
        
    //     return new Muestra([
    //         'analisis' => $row['analisis'],
    //         'valor_analisis' => $row['valor_analisis'],
    //         'metodo_analisis' => $row['metodo_analisis'],
    //         'uds' => $row['unidades'],
    //         'observaciones' => $row['observaciones'],
    //         'nombre_comun_latino' => $row['nombre_latino'],
    //         'grupo_id' => MuestrasImport::grupoId($row['grupo']),
    //         'tipo_id' => MuestrasImport::tipoId($row['tipo']),
    //         'nombre' => $row['nombre'],
    //         'inicio_fecha_recogida' => Carbon::parse($row['inicio_fecha_recogida'])->format('Y-m-d'),
    //         'final_fecha_recogida' => Carbon::parse($row['final_fecha_recogida'])->format('Y-m-d'),
    //         'user_id' => $this->user,
           
    //     ]);

        


    // }

    public static function grupoId($grupo){
        $grupoId = Grupo::where('grupo',$grupo)->first()->id;

        return $grupoId;
    }

    public static function tipoId($tipo){
        $tipoId = Tipo::where('tipo',$tipo)->first()->id;
        

        return $tipoId;
    }
}
