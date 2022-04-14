<?php

use Illuminate\Database\Seeder;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grupos')->insert([
            ['id' => 1, 'grupo' => 'WEENDE'],
            ['id' => 2, 'grupo' => 'VAN SOEST'],
            ['id' => 3, 'grupo' => 'GLUCIDOS Y COMPUESTOS SECUNDARIOS'],
            ['id' => 4, 'grupo' => 'LIPIDOS'],
            ['id' => 5, 'grupo' => 'NITROGENADOS'],
            ['id' => 6, 'grupo' => 'MINERALES'],
            ['id' => 7, 'grupo' => 'VITAMINAS'],
            ['id' => 8, 'grupo' => 'TOXICOS/ANTINUTRITIVOS'],
            ['id' => 9, 'grupo' => 'ADITIVOS'],
            ['id' => 10, 'grupo' => 'MICROBIOLOGOS'],
            ['id' => 11, 'grupo' => 'TECNICOS'],
            ['id' => 12, 'grupo' => 'DIGESTIBILIDAD/DEGRADABILIDAD/INGESTIBILIDAD'],
            ['id' => 13, 'grupo' => 'VALORES ENERGETICOS'],
            ['id' => 14, 'grupo' => 'SIN GRUPO'],
        ]);

    }
}
