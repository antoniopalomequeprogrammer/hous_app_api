<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PlantillaImport 
implements WithMultipleSheets
{
    
    public function sheets(): array
    {

        return [
            'Plantilla Muestras' => new MuestrasImport(),
            'Plantilla Analisis' => new AnalisisImport(),
        ];

    }
}
