<?php

namespace App\Imports;
use App\Models\Analisi;
use App\Models\Muestra;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\HasReferencesToOtherSheets;
class AnalisisImport implements ToCollection,WithHeadingRow,WithCalculatedFormulas
{   

    public function collection(Collection $rows)
    {   
        
        
        foreach ($rows as $row) {
            $muestraId = Muestra::where('nombre',$row['muestra'])->orderBy('created_at','desc')->first()->id;
            
            
            Analisi::create([
                'analisis' => $row['analisis'],
                'unidades' => $row['unidades'],
                'numero' => $row['numero'],
                'media' => $row['media'],
                'minimo' => $row['minimo'],
                'maximo' => $row['maximo'],
                'desviacion_tipica' => $row['desviacion_tipica'],
                'muestra_id' => $muestraId,
            ]); 
        }
        
    }

}
