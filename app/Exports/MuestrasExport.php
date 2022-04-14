<?php

namespace App\Exports;
use App\Models\Muestra;
use Maatwebsite\Excel\Concerns\FromCollection;

class MuestrasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Muestra::all();
    }
}
