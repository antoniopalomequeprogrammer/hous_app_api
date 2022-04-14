<?php

use Illuminate\Database\Seeder;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos')->insert([
            ['id' => 1, 'tipo' => 'TODOS'],
            ['id' => 2, 'tipo' => 'ANÁLISIS ACREDITADOS'],
        ]);
    }
}
