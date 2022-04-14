<?php

namespace App\Imports;
use Carbon\Carbon;
use App\Models\Muestra;
use App\Models\Grupo;
use App\Models\Tipo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\HasReferencesToOtherSheets;

class MuestrasImport implements ToCollection,WithHeadingRow,HasReferencesToOtherSheets
{
    protected  $user;

    public function __construct(){
        $this->user = Auth::user()->id;
    }
    
    public function collection(Collection $rows)
    {   
        
        foreach ($rows as $row) {

            Muestra::create([
                'nombre' => $row['nombre'],
                'nombre_comun_latino' => $row['nombre_latino'],
                'valor_analisis' => $row['valor_analisis'],
                'uds' => $row['unidades'],
                'metodo_analisis' => $row['metodo_analisis'],
                'observaciones' => $row['observaciones'],
                'inicio_fecha_recogida' => Carbon::parse($row['inicio_fecha_recogida'])->format('Y-m-d'),
                'final_fecha_recogida' => Carbon::parse($row['final_fecha_recogida'])->format('Y-m-d'),
                'grupo_id' => MuestrasImport::grupoId($row['grupo']),
                'tipo_id' => MuestrasImport::tipoId($row['tipo']),
                'user_id' => $this->user,
               
            ]);
            

            
        }
        
    }

    public static function grupoId($grupo){
        $grupoId = Grupo::where('grupo',$grupo)->first()->id;
        return $grupoId;
    }

    public static function tipoId($tipo){
        $tipoId = Tipo::where('tipo',$tipo)->first()->id;
        return $tipoId;
    }
}
